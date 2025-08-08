<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use Illuminate\Support\Facades\Redirect;

class TeacherController extends Controller
{
    public function index()
    {
        $tenantId= Auth::user()->tenant_id; // Assuming tenant_id is stored in the user model
        $teachers = Teacher::where('tenant_id', $tenantId)->get();
        return Inertia::render('teacher/index', [
            'teachers' => $teachers,
            'tenantId' => $tenantId,
        ]);
    }

    public function store(Request $request)
    {
        $tenantId = Auth::user()->tenant_id; // Assuming tenant_id is stored in the user model
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
        ]);

        $validated['tenant_id'] =Auth::user()->tenant_id ;

        Teacher::create($validated);

        return Redirect::route('teachers.index');
    }

    public function upadate(Request $request, $id)
    {
        // Assuming tenant_id is stored in the user model
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
        ]);

        $teacher = Teacher::where('tenant_id', Auth::user()->tenant_id)->findOrFail($id);
        $teacher->update($data);

        return Redirect::route('teachers.index');
    }

    public function destroy($id)
    {
        $tenantId = Auth::user()->tenant_id; // Assuming tenant_id is stored in the user model
        $teacher = Teacher::where('tenant_id', $tenantId)->findOrFail($id);
        $teacher->delete();

        return Redirect::route('teachers.index');
    }
}
