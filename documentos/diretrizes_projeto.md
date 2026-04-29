# Diretrizes do Projeto Creator RPG

Este documento estabelece os padrões técnicos e estéticos para o desenvolvimento do **CreatorCloud**, um sistema de gerenciamento de fichas de RPG medieval com suporte a D&D 3.5 e 5.0.

## 1. Visão Geral do Projeto
O objetivo é criar uma experiência imersiva que remeta a tomos antigos e pergaminhos mágicos, unindo uma interface visual premium com interatividade sonora.

---

## 2. Stack Tecnológica
- **Backend**: Laravel (PHP)
- **Frontend**: Blade Templates
- **Estilização**: Tailwind CSS (Customizado)
- **Interatividade**: JavaScript (Alpine.js)
- **Efeitos Sonoros**: Web Audio API / Vanilla JS
- **Ícones**: FontAwesome 6

---

## 3. Design System (Aesthetics)

### Identidade Visual
A interface utiliza o conceito de **"Glass Parchment"** (Pergaminho translúcido com desfoque).

#### Paleta de Cores (Parchment)
- **Parchment 100**: `#fdf6e3` (Papel limpo)
- **Parchment 200**: `#f4e8c1` (Papel envelhecido - Fundo Principal)
- **Parchment 300**: `#e8d5a5` (Destaque suave)
- **Parchment 400**: `#d1b882` (Bordas e detalhes)
- **Parchment 800**: `#5a4624` (Texto secundário)
- **Parchment 900**: `#3d2b14` (Texto principal)

#### Cores de Acento
- **Magic (Roxo)**: `#8b5cf6` (Botões de ação positiva, magia)
- **Blood (Vermelho)**: `#dc2626` (Botões de destruição, perigo, combate)

#### Tipografia
- **Títulos (Headings)**: `Cinzel`, serif (Estilo épico/romano)
- **Corpo de Texto**: `Lora`, serif (Estilo clássico/manuscrito)

#### Texturas
- **Base**: `aged-paper.png` (Transparência sutil sobre o fundo)

---

## 4. Sistema de Imersão (SFX)
Toda interação deve fornecer feedback sonoro para aumentar a imersão.

| Ação | Efeito Sonoro | Gatilho Comum |
| :--- | :--- | :--- |
| **Hover** | `hover.mp3` | Passar o mouse em links/botões |
| **Páginas** | `page.mp3` | Navegação entre menus e abas |
| **Combate/Deletar** | `sword.mp3` | Excluir registros ou ações de ataque |
| **Magia/Salvar** | `magic.mp3` | Criar registros ou submeter formulários |
| **Alerta/Erro** | `explosion.mp3` | Mensagens de erro crítico |

**Implementação**: Centralizada no `app.blade.php` via objeto `window.sfx`.

---

## 5. Padrões de Dados (D&D Core)

### Modularidade de Versões
O sistema deve suportar múltiplas edições através da coluna `versao` nos modelos.
- **5.0**: Foco em bônus positivos e deslocamento em metros (conversão: 5ft = 1.5m).
- **3.5**: Foco em modificadores de habilidade (incluindo negativos) e penalidades raciais.

### Convenção de Modelos (Exemplo: Raca)
- Atributos devem ser explícitos: `mod_forca`, `mod_destreza`, etc.
- Descrições devem ser ricas em lore (itálico e aspas na visualização).

---

## 6. Estrutura de Componentes Blade
Sempre que possível, utilizar as classes utilitárias customizadas no Tailwind:
- `.glass-parchment`: Container padrão para cards e modais.
- `.btn-medieval`: Botões com animação de levitação e sombra.
- `.font-cinzel`: Para textos que precisam de autoridade e peso.

---

## 7. Melhores Práticas de Desenvolvimento
1. **Não use Placeholders**: Para imagens, utilize o gerador de arte ou texturas reais.
2. **Micro-animações**: Use transições suaves (`transition`, `hover:scale-105`) em todos os elementos interativos.
3. **SEO & Semântica**: Use tags `<h1>` para títulos de página e IDs únicos em botões para facilitar testes automáticos.
