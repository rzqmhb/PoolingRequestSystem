<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestApprover;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RequestApproverController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : int
    {
        return RequestApprover::insertGetId([
            'approver1_id' => $request->input('approver1_id'),
            'approver2_id' => $request->input('approver2_id'),
        ]);
    }
/**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $approvers = RequestApprover::findOrFail($id);
            $data = $request->validate([
                'approver_id' => ['required'],
                'decision' => ['required'],
            ]);

            if ($data['approver_id'] === $approvers->approver1_id) {
                $approvers->update(['approver1_status'=> $data['decision']]);
            } else {
                $approvers->update(['approver2_status'=> $data['decision']]);
            }
        } catch (ModelNotFoundException $e) {
            //throw $e;
        }
    }
}
