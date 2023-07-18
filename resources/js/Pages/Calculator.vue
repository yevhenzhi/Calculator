<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

let result;

const rvalues = Array(31).fill().map((element, index) => index + 30)

const form = useForm({
    length: '',
    width: '',
    height: '',
    roof_slope: null,
    r_value: null,
});

const submit = () => {
    axios.post(route('calculate'), form.data())
        .then(res => {
            result = res.data
            form.reset('length', 'width', 'height', 'roof_slope', 'r_value')
        })
};
</script>

<template>
    <Head title="Calculator" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100"
    >

        <form @submit.prevent>
            <div>
                <InputLabel for="length" value="Length" />

                <TextInput
                    id="length"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.length"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.length" />
            </div>

            <div>
                <InputLabel for="width" value="Width" />

                <TextInput
                    id="width"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.width"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.width" />
            </div>

            <div>
                <InputLabel for="height" value="Height" />

                <TextInput
                    id="height"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.height"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.height" />
            </div>

            <div>
                <InputLabel for="roof_slope" value="Roof slope" />

                <TextInput
                    id="roof_slope"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.roof_slope"
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.roof_slope" />
            </div>

            <div >
                <InputLabel for="r_value" value="R value" />

                <select
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    v-model="form.r_value"
                >
                    <option
                        id="r_value"
                        v-for="i in rvalues" :key="i"
                    >
                        {{ i }}
                    </option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton @click="submit()" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Calculate
                </PrimaryButton>
            </div>

            <div v-if="result" class="font-medium text-sm text-green-600">
                <p>Result: {{ result }}</p>
            </div>

        </form>
    </div>
</template>

