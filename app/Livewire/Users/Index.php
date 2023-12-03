<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $query = "";

    public int $limit = 10;

    public string $field = "created_at";

    public string $direction = "desc";

    public function sortBy($column): void
    {
        if ($this->field === $column) {
            $this->direction = $this->direction === "asc" ? "desc" : "asc";
        } else {
            $this->direction = "asc";
        }

        $this->field = $column;
    }

    public function updated($property): void
    {
        if ($property === "query") {
            $this->resetPage();
        }
    }

    public function render()
    {
        $users = User::query()
            ->withCount("posts")
            ->when($this->query, function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where("name", "like", "%" . $this->query . "%")
                        ->orWhere("email", "like", "%" . $this->query . "%");
                });
            })
            ->when(
                $this->field && $this->direction,
                function ($query) {
                    $query->orderBy($this->field, $this->direction);
                },
                fn($query) => $query->latest(),
            )
            ->paginate($this->limit);

        return view("livewire.users.index", [
            "users" => $users,
        ]);
    }
}
