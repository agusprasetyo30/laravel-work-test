<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required', 'email', 'unique:members,email',
        ]);

        Member::create($request->all());

        return $this->success($request->all(), 'Member has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return $this->success($member, 'Member has been deleted successfully');
    }


    public function datatables(Request $request) {
        $get_members = Member::query();

        return datatables($get_members)
            ->addColumn('actions', function($todo) {
                $delete_button = "<a type='button' class='btn btn-icon btn-danger text-white delete-member-button' data-delete-route='" . route('admin.master.member.destroy', ':id') . "'><i class='fas fa-trash'></i></a>";

                return "<div class='btn-group'>{$delete_button}</div>";
            })

            ->escapeColumns([])
            ->make();
    }
}
