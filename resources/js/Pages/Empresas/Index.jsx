import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import InputError from "@/Components/InputError.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import { useForm, Head } from "@inertiajs/react";

export default function Index({ auth }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        nombre: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('empresas.create'), { onSuccess: () => reset() });
    };

    return (
        <AuthenticatedLayout>
            <Head title="Empresas" />

            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>
                    <textarea
                        value={data.nombre}
                        placeholder="What's on your mind?"
                        className="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        onChange={e => setData('message', e.target.value)}
                    ></textarea>
                    <InputError message={errors.message} className="mt-2" />
                    <PrimaryButton className="mt-4" disabled={processing}>Empresa</PrimaryButton>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
