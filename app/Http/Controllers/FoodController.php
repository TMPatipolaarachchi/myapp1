<?php
namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // BUYERS (public)
    public function publicIndex()
    {
        $foods = Food::all();
        return view('foods.public', compact('foods'));
    }

    // ADMIN
    public function index()
    {
        $foods = Food::all();
        return view('admin.foods.index', compact('foods'));
    }

    public function create()
    {
        return view('admin.foods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $imagePath = $request->file('image')->store('foods', 'public');

        Food::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.foods.index');
    }

    public function edit(Food $food)
    {
        return view('admin.foods.edit', compact('food'));
    }

    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $food->image = $request->file('image')->store('foods', 'public');
        }

        $food->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.foods.index');
    }

    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('admin.foods.index');
    }

    // PROFILE
    public function profile()
    {
        return view('admin.profile');
    }
}
