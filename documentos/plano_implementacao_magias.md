# Plano de Implementação: Módulo de Magias

Criar um módulo completo para gerenciar magias, desenhado especificamente para as necessidades mecânicas do D&D 3.5, mantendo suporte a versões para outras edições.

## Revisão do Usuário Necessária

> [!NOTE]
> No D&D 3.5, as magias têm níveis diferentes dependendo da classe (ex: uma magia pode ser Nível 2 para um Feiticeiro, mas Nível 3 para um Bardo). Vou implementar um relacionamento muitos-para-muitos entre Magias e Classes com uma coluna pivô para o nível.

## Mudanças Propostas

### Banco de Dados & Modelos

#### Criar tabela `magias`:
- `nome` (string)
- `escola` (string) - ex: Abjuração, Invocação
- `componentes` (string) - ex: V, S, M
- `tempo_execucao` (string)
- `alcance` (string)
- `alvo_area_efeito` (string)
- `duracao` (string)
- `teste_resistencia` (string)
- `resistencia_magia` (string)
- `descricao` (text)
- `versao` (string) - padrão '3.5'

#### Criar tabela pivô `classe_magia`:
- `magia_id` (foreignId)
- `classe_id` (foreignId)
- `nivel` (integer)

#### Modelo `Magia.php`:
- Relacionamento Eloquent com `Classe` usando `belongsToMany`.

---

### Lógica de Backend

#### `MagiaController.php`:
- Listagem de magias (filtradas por versão).
- Criação/Edição de magias com atribuição de níveis por classe.
- Visualização de detalhes da magia.

#### `web.php`:
- Adicionar `Route::resource('magias', MagiaController::class)`.

---

### UI & UX (Estética Medieval)

#### `index.blade.php`:
- Lista de magias em estilo pergaminho com filtros.

#### `create.blade.php`:
- Formulário para criar magias, incluindo uma seção dinâmica para adicionar associações de Classe/Nível.

#### `show.blade.php`:
- Uma visualização em estilo "Pergaminho de Magia" para exibir os detalhes.

#### `app.blade.php`:
- Adicionar "Magias" ao menu de navegação.

## Plano de Verificação

### Verificação Manual
1. Navegar para o novo item de menu "Magias".
2. Criar uma nova magia (ex: "Bola de Fogo") e atribuí-la a "Mago" no Nível 3.
3. Verificar se a magia aparece na lista.
4. Visualizar os detalhes da magia e conferir o layout.
5. Editar a magia e verificar as mudanças.
