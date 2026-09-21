<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index()
    {
        $members = [
            [
                'id' => 1,
                'nama' => 'Andi',
                'nim' => '23001',
                'email' => 'andi@gmail.com',
                'nomor_telepon' => '081234567890',
                'alamat' => 'Surabaya',
                'status' => 'aktif',
            ],
            [
                'id' => 2,
                'nama' => 'Budi',
                'nim' => '23002',
                'email' => 'budi@gmail.com',
                'nomor_telepon' => '081234567891',
                'alamat' => 'Sidoarjo',
                'status' => 'aktif',
            ],
        ];

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created member.
     */
    public function store(StoreMemberRequest $request)
    {
        return redirect()
            ->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Display the specified member.
     */
    public function show(string $id)
    {
        return 'MemberController@show, id: ' . $id;
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(string $id)
    {
        return 'MemberController@edit, id: ' . $id;
    }

    /**
     * Update the specified member.
     */
    public function update(Request $request, string $id)
    {
        return 'MemberController@update, id: ' . $id;
    }

    /**
     * Remove the specified member.
     */
    public function destroy(string $id)
    {
        return 'MemberController@destroy, id: ' . $id;
    }
}