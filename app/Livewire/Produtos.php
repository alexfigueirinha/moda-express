<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Produto;

class Produtos extends Component
{
    use WithPagination;

    public $search = '';
    public $produtoId;
    public $nome;
    public $descricao;
    public $preco;
    public $quantidade;
    public $quantidade_minima;
    public $isEditing = false;
    public $showForm = false;

    protected $rules = [
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string',
        'preco' => 'required|numeric|min:0',
        'quantidade' => 'required|integer|min:0',
        'quantidade_minima' => 'required|integer|min:0'
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showForm = true;
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $this->produtoId = $id;
        $this->nome = $produto->nome;
        $this->descricao = $produto->descricao;
        $this->preco = $produto->preco;
        $this->quantidade = $produto->quantidade;
        $this->quantidade_minima = $produto->quantidade_minima;
        $this->isEditing = true;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'quantidade' => $this->quantidade,
            'quantidade_minima' => $this->quantidade_minima
        ];

        if ($this->isEditing) {
            Produto::findOrFail($this->produtoId)->update($data);
            session()->flash('message', 'Produto atualizado com sucesso!');
        } else {
            Produto::create($data);
            session()->flash('message', 'Produto criado com sucesso!');
        }

        $this->resetForm();
        $this->showForm = false;
    }

    public function delete($id)
    {
        Produto::findOrFail($id)->delete();
        session()->flash('message', 'Produto excluído com sucesso!');
    }

    private function resetForm()
    {
        $this->reset(['produtoId', 'nome', 'descricao', 'preco', 'quantidade', 'quantidade_minima']);
    }

    public function render()
    {
        $produtos = Produto::when($this->search, function ($query) {
            return $query->where('nome', 'like', '%' . $this->search . '%');
        })->paginate(10);

        return view('livewire.produtos', compact('produtos'));
    }
}
