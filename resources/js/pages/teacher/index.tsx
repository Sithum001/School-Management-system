import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import {usePage,router} from '@inertiajs/react';
import {Card} from '@/components/ui/card';  
import {Button} from '@/components/ui/button';
import {Input} from '@/components/ui/input';
import {Label} from '@/components/ui/label';
import { useState } from 'react';           

interface Teacher {
    teacher_id: number;
    tenant_id: number;
    first_name: string; 
    last_name: string;
    subject: string;
}
    const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Teachers',
        href: '/dashboard',
    },
];

const emptyForm ={first_name: '', last_name: '', subject: ''};

type FormState =typeof emptyForm & { id?: number };
export default function TeacherIndex() {
    const { teachers } = usePage<{teachers?: Teacher[]}>().props;
    const teacherList = teachers ?? [];

    const [open,setOpen] = useState(false);
    const [form, setForm] = useState<FormState>(emptyForm); 
    const [isEdit,setEdit] =useState(false);
    

    const handleOpenAdd = () =>{
        setForm(emptyForm);
        setEdit(false);
        setOpen(true);
    }
    const handleOpenEdit = (teacher: Teacher) => {
        setForm({
            id: teacher.teacher_id,
            first_name: teacher.first_name,
            last_name: teacher.last_name,
            subject: teacher.subject
        });
        setEdit(true);
        setOpen(true);
    }

    const handleClose =(e: React.ChangeEvent<HTMLInputElement>) =>{
         setForm({...form,[e.target.name]: e.target.value});
    };
    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        if (isEdit && form.id) {
            router.put(`/teachers/${form.id}`, form,{
                onSuccess: () => setOpen(false),
            });
        } else {
            router.post('/teachers', form);
        }
        setOpen(false);
    };
}