<x-team-layout :team="$team">

    <x-slot name="pageTitle">
        {{ page_title(__('Update Card - :name', ['name' => $team->name])) }}
    </x-slot>

    <section>
        <x-card class="card mb-4">
            <x-slot name="header">
                <h5 class="text-lg font-semibold">{{ __('Update Card') }}</h5>
            </x-slot>

            <div class="card-body">
                <form id="payment-form" method="POST" action="{{ route('teams.subscriptions.payment-methods.store', $team) }}">
                    @csrf

                    <div id="card-error" class="mb-1 text-red-500"></div>

                    <div>
                        <x-input-label for="card-holder-name">{{ __('Full name') }}</x-input-label>

                        <x-input type="text" id="card-holder-name" class="w-full mt-2" value="{{ $team->name }}" />
                    </div>

                    <div class="py-2 mt-4 mb-3">
                        <x-input-label class="mb-3">{{ __('Card details') }}</x-input-label>

                        <!-- Stripe Elements Placeholder -->
                        <div id="card-element"></div>

                        <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                    </div><!-- /.form-group -->

                    <div class="mt-4">
                        <x-button type="submit" id="card-button" light bold size="sm"
                            data-secret="{{ optional($intent)->client_secret }}">
                            {{ __('Update Card') }}
                        </x-button>
                    </div><!-- /.form-group -->
                </form><!-- /form -->
            </div><!-- /.card-body -->
        </x-card><!-- /.card -->
    </section><!-- /.row -->
</x-team-layout>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe(@js(config('services.stripe.key')));
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        e.preventDefault()
        const { setupIntent, error } = await stripe.confirmCardSetup(clientSecret, {
            payment_method: {
                card: cardElement,
                billing_details: {
                    name: cardHolderName.value
                }
            }
        });

        if (error) {
            // Display "error.message" to the user...
            document.getElementById('card-error').innerText = error.message
            document.getElementById('card-button').disabled = false
        } else {
            let form = document.getElementById('payment-form')

            cardButton.disabled = true

            $input = document.createElement('input')
            $input.type = 'hidden'
            $input.name = 'payment_method'
            $input.value = setupIntent.payment_method

            form.append($input)

            form.submit()
        }
    });
</script>