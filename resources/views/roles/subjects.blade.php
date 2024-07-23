<section class="space-y-6 ">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('ادخل علاماتك') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('ادخالك لعلاماتك في سنواتك الدراسية يزيد من احتمالية ايجاد المرضى , حيث يؤثر على تقييمك في الموقع') }}
        </p>
    </header>

    <x-primary-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'enter-marks')"
    >{{ __('إدخال العلامات') }}</x-primary-button>

    <x-modal name="enter-marks" :show="$errors->isNotEmpty()" focusable>
        <br>
        <br>

        <form method="post" action="{{ route('subject.store') }}" class="p-6 bg-white rounded-lg shadow-lg relative z-50">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('من فضلك قم بادخال علامتك بكل مادة من هذه المواد') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('قم بالتحقق من ان العلامات صحيحة, لن تتمكن من تعديل العلامة التي تدخلها!') }}
            </p>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('تأكد من ادخالك على الاقل علامات لـ9 مواد حتى يصبح لك تقييم') }}
            </p>

            @foreach($subjects as $subject)
                <div class="mt-6">
                    <x-input-label for="subject_{{ $subject->su_id }}" value="{{ $subject->name }}" class="sr-only" />
                    <x-text-input
                        id="subject_{{ $subject->su_id }}"
                        name="subjects[{{ $subject->su_id }}]"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="{{ $subject->name }}"
                    />
                    <x-input-error :messages="$errors->get('subjects.' . $subject->su_id)" class="mt-2" />
                </div>
            @endforeach

            <input type="hidden" value="{{ auth()->user()->id }}" name="id">

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('إلغاء') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('تأكيد وحفظ') }}
                </x-primary-button>

            </div>
        </form>
    </x-modal>
</section>

<style>
    [x-cloak] {
        display: none;
    }
    .modal {
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('modal', () => ({
            open: false,
            show() {
                this.open = true;
                document.body.classList.add('overflow-hidden');
            },
            hide() {
                this.open = false;
                document.body.classList.remove('overflow-hidden');
            },
        }));
    });
</script>
