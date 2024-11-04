<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::with(['transactionAccount'])->get();

        if ($transaction->count() > 0) {
            return response()->json([
                'status' => 200,
                'transaction' => $transaction,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records found',
            ], 404);
        }
    }

    public function account()
    {
        $account = Account::all();

        if ($account->count() > 0) {
            return response()->json([
                'status' => 200,
                'account' => $account,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required',
            'code' => 'required',
            'date' => 'required',
            'account_id' => 'required',
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $items = Transaction::create([
                'company' => $request->company,
                'code' => $request->code,
                'date' => $request->date,
                'account_id' => $request->account_id,
                'note' => $request->note,
            ]);

            if ($items) {
                return response()->json([
                    'status' => 200,
                    'message' => "Transaction has been created successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $transaction = Transaction::with(['transactionAccount'])->find($id);
        if ($transaction) {
            return response()->json([
                'status' => 200,
                'transaction' => $transaction
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such data found"
            ], 500);
        }
    }

    public function edit(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required',
            'code' => 'required',
            'date' => 'required',
            'account_id' => 'required',
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $items = Transaction::find($id);
            if ($items) {
                $items->update([
                    'company' => $request->company,
                    'code' => $request->code,
                    'date' => $request->date,
                    'account_id' => $request->account_id,
                    'note' => $request->note,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Transaction has been updated successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No such Transaction was found"
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $item = Transaction::find($id);
        if ($item) {
            $item->delete();

            return response()->json([
                'status' => 200,
                'message' => "Master Transaction has been deleted successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such Transaction was found"
            ], 404);
        }
    }

    public function indexDetail($id)
    {
        $transaction = TransactionDetail::with(['transactionId', 'transactionItem', 'transactionItemUnit'])
            ->where('transaction_id', $id)
            ->get();

        if ($transaction->count() > 0) {
            return response()->json([
                'status' => 200,
                'transaction' => $transaction,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No records found',
            ], 404);
        }
    }

    public function storeDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'master_item_id' => 'required',
            'quantity' => 'required',
            'item_unit_id' => 'required',
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $items = TransactionDetail::create([
                'transaction_id' => $request->transaction_id,
                'master_item_id' => $request->master_item_id,
                'quantity' => $request->quantity,
                'item_unit_id' => $request->item_unit_id,
                'note' => $request->note,
            ]);

            if ($items) {
                return response()->json([
                    'status' => 200,
                    'message' => "Transaction has been created successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ], 500);
            }
        }
    }

    public function showDetail($id)
    {
        $transaction = TransactionDetail::with(['transactionId', 'transactionItem', 'transactionItemUnit'])->find($id);
        if ($transaction) {
            return response()->json([
                'status' => 200,
                'transaction' => $transaction
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such data found"
            ], 500);
        }
    }

    public function editDetail(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required',
            'master_item_id' => 'required',
            'quantity' => 'required',
            'item_unit_id' => 'required',
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $items = TransactionDetail::find($id);
            if ($items) {
                $items->update([
                    'transaction_id' => $request->transaction_id,
                    'master_item_id' => $request->master_item_id,
                    'quantity' => $request->quantity,
                    'item_unit_id' => $request->item_unit_id,
                    'note' => $request->note,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Transaction has been updated successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No such Transaction was found"
                ], 404);
            }
        }
    }

    public function destroyDetail($id)
    {
        $item = TransactionDetail::find($id);
        if ($item) {
            $item->delete();

            return response()->json([
                'status' => 200,
                'message' => "Master Transaction has been deleted successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No such Transaction was found"
            ], 404);
        }
    }
}
