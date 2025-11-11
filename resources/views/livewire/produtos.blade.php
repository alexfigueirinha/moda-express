<div>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Cadastro de Produtos</h2>
            <div>
                <a class="btn btn-secondary me-2" href="{{ route('dashboard') }}">Voltar</a>
                <button class="btn btn-success" wire:click="create">Novo Produto</button>
            </div>
        </div>

        @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <!-- Formulário de Produto -->
        @if($showForm)
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ $isEditing ? 'Editar Produto' : 'Novo Produto' }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit="save">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" wire:model="nome">
                                @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Preço</label>
                                <input type="number" step="0.01" class="form-control" wire:model="preco">
                                @error('preco') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea class="form-control" rows="3" wire:model="descricao"></textarea>
                        @error('descricao') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Quantidade em Estoque</label>
                                <input type="number" class="form-control" wire:model="quantidade">
                                @error('quantidade') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Quantidade Mínima</label>
                                <input type="number" class="form-control" wire:model="quantidade_minima">
                                @error('quantidade_minima') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">{{ $isEditing ? 'Atualizar' : 'Salvar' }}</button>
                        <button type="button" class="btn btn-secondary"
                            wire:click="$set('showForm', false)">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- Busca -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Buscar produto por nome..."
                            wire:model.live="search">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela de Produtos -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th>Mínimo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ Str::limit($produto->descricao, 50) }}</td>
                                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td>{{ $produto->quantidade }}</td>
                                <td>{{ $produto->quantidade_minima }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning me-1"
                                        wire:click="edit({{ $produto->id }})">Editar</button>
                                    <button class="btn btn-sm btn-danger"
                                        onclick="confirm('Tem certeza?') || event.stopImmediatePropagation()"
                                        wire:click="delete({{ $produto->id }})">Excluir</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $produtos->links() }}
            </div>
        </div>
    </div>

    <script>
        Livewire.on('redirect', (data) => {
            window.location.href = data.url;
        });
    </script>
</div>