<?php

namespace App\Actions\Transaction;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CreateNewTransaction {

    /**
     * Validate and create a newly transaction.
     *
     * @param  array  $input
     * @return \App\Models\Transaction
     */
    public function create(array $input) {
        $messages = [
            'user_id.required'=>__('Please choose User!'),
            'type.required'=>__('This choose type of transaction!'),
            'amount.required'=>__('Please input amount of transaction!'),
            'amount.numeric'=>__('Type of Amount not match!'),
            'amount.min'=>__('Please input amount larger than 0!'),
        ];
        Validator::make($input, [
            'user_id' => ['required'],
            'type' => ['required'],
            'amount' => ['required', 'numeric', 'min:0'],
        ], $messages)->validate();
        return Transaction::create([
            'user_id' => $input['user_id'],
            'author' => isset($input['author']) ? $input['author'] : Auth::id(),
            'type' => $input['type'],
            'amount' => $input['amount'],
            'content' => isset($input['content']) ? $input['content'] : NULL,
            'status' => isset($input['status']) ? $input['status'] : NULL,
            'image' => isset($input['image']) ? $input['image'] : NULL,
            'user_action' => isset($input['user_action']) ? $input['user_action'] : 'no',
        ]);
    }
}
