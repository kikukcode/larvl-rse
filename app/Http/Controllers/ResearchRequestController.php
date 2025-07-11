<?php

namespace App\Http\Controllers;

use App\Models\ResearchRequest;
use Illuminate\Http\Request;

class ResearchRequestController extends Controller
{
    //

    public function index()
    {

        $researches = ResearchRequest::all();

        $data = [
            'title' => 'Data Riset Mahasiswa',
            'researches' => $researches
        ];
        return view('admin.research.index', $data);
    }

    public function create()
    {
        return view('admin.research.create');
    }

    public function edit($id)
    {
        $research = ResearchRequest::findOrFail($id);
        return view('admin.research.edit', compact('research'));
    }

    public function show($id)
    {
        $research = ResearchRequest::findOrFail($id);
        return view('admin.research.show', compact('research'));
    }

    public function  store(Request $request)
    {
        //validasi
        $request->validate([
            'student_name' => 'required|string',
            'research_title' => 'required|string',
            'target_institution' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // cek apakah ada file
        if (!$request->hasFile('document_file')) {
            return back()->with('error', 'File tidak ada');
        }

        // upload file
        $file = $request->file('document_file');
        $fileName = $request->input('student_name') . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('research_docs', $fileName, 'public');

        // simpan data
        ResearchRequest::create([
            'student_name' => $request->input('student_name'),
            'research_title' => $request->input('research_title'),
            'target_institution' => $request->input('target_institution'),
            'document_file' => $path
        ]);

        return redirect()->route('researchrequest.index')->with('success', 'Permohonan riset berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        //validasi
        $request->validate([
            'student_name' => 'required|string',
            'research_title' => 'required|string',
            'target_institution' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // cek apakah ada file
        if (!$request->hasFile('document_file')) {
            return back()->with('error', 'File tidak ada');
        }

        // upload file
        $file = $request->file('document_file');
        $fileName = $request->input('student_name') . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('research_docs', $fileName, 'public');

        // simpan data
        $research = ResearchRequest::findOrFail($id);
        $research->update([
            'student_name' => $request->input('student_name'),
            'research_title' => $request->input('research_title'),
            'target_institution' => $request->input('target_institution'),
            'document_file' => $path
        ]);

        return redirect()->route('researchrequest.index')->with('success', 'Permohonan riset berhasil disimpan');
    }

    public function destroy($id)
    {
        $research = ResearchRequest::findOrFail($id);
        $research->delete();
        return redirect()->route('researchrequest.index')->with('success', 'Permohonan riset berhasil dihapus');
    }
}
