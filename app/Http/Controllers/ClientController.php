<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::with('user');

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%')
                  ->orWhere('telephone', 'like', '%' . $request->search . '%');
        }

        $clients = $query->orderBy('nom')->paginate(5)->withQueryString();

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $users = User::where('role', 'client')
                     ->whereDoesntHave('client')
                     ->orderBy('name')
                     ->get();

        return view('clients.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'       => ['required', 'string', 'max:255'],
            'adresse'   => ['nullable', 'string', 'max:500'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'user_id'   => ['nullable', 'exists:users,id'],
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')
                         ->with('success', 'Client créé avec succès.');
    }

    public function show(Client $client)
    {
        $client->load(['user', 'commandes.facture']);
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        $users = User::where('role', 'client')
                     ->where(function ($q) use ($client) {
                         $q->whereDoesntHave('client')
                           ->orWhere('id', $client->user_id);
                     })
                     ->orderBy('name')
                     ->get();

        return view('clients.edit', compact('client', 'users'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'nom'       => ['required', 'string', 'max:255'],
            'adresse'   => ['nullable', 'string', 'max:500'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'user_id'   => ['nullable', 'exists:users,id'],
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')
                         ->with('success', 'Client mis à jour avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')
                         ->with('success', 'Client supprimé avec succès.');
    }
}
