<?php

namespace Database\Seeders;

use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // Usuários
        User::create([
            'name' => 'Admin',
            'email' => 'admin@modaexpress.com',
            'password' => Hash::make('senha123'),
        ]);

        User::create([
            'name' => 'João Silva',
            'email' => 'joao@modaexpress.com',
            'password' => Hash::make('senha123'),
        ]);

        User::create([
            'name' => 'Maria Santos',
            'email' => 'maria@modaexpress.com',
            'password' => Hash::make('senha123'),
        ]);

        // Produtos
        $produtos = [
            [
                'nome' => 'Camiseta Básica',
                'descricao' => 'Camiseta 100% algodão, cores variadas',
                'preco' => 29.90,
                'quantidade' => 50,
                'quantidade_minima' => 10
            ],
            [
                'nome' => 'Calça Jeans',
                'descricao' => 'Calça jeans masculina, modelo slim',
                'preco' => 89.90,
                'quantidade' => 30,
                'quantidade_minima' => 5
            ],
            [
                'nome' => 'Vestido Floral',
                'descricao' => 'Vestido feminino com estampa floral',
                'preco' => 119.90,
                'quantidade' => 15,
                'quantidade_minima' => 3
            ]
        ];

        foreach ($produtos as $produto) {
            Produto::create($produto);
        }

        // Movimentações
        $movimentacoes = [
            [
                'produto_id' => 1,
                'tipo' => 'entrada',
                'quantidade' => 50,
                'data_movimentacao' => now()->subDays(10)
            ],
            [
                'produto_id' => 2,
                'tipo' => 'entrada',
                'quantidade' => 30,
                'data_movimentacao' => now()->subDays(8)
            ],
            [
                'produto_id' => 3,
                'tipo' => 'entrada',
                'quantidade' => 15,
                'data_movimentacao' => now()->subDays(5)
            ]
        ];

        foreach ($movimentacoes as $movimentacao) {
            Movimentacao::create($movimentacao);
        }
    }
}
