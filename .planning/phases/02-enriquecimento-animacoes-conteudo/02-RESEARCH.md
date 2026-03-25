# Phase 2: Enriquecimento — Animações + Conteúdo - Research

**Researched:** 2026-03-25
**Domain:** HTML puro + CSS animations + IntersectionObserver + Tailwind CDN
**Confidence:** HIGH

---

<user_constraints>
## User Constraints (from CONTEXT.md)

### Locked Decisions
- Seção dedicada, separada do hero — não manter os números apenas no hero
- Fundo: vermelho GM (#ff2a2a) com texto branco — contraste forte com o dark do restante da página
- Layout: 3 colunas iguais, grid horizontal
- Posição: imediatamente após o hero (antes da seção de logos/clientes)
- Os números do hero devem ser REMOVIDOS e migrados para esta seção dedicada
- Headline da seção: "Resultados que falam por si"
- Sem sub-headline — os números se justificam sozinhos
- Sem narrativa before/after explícita — a relação investido/faturado fica implícita
- Glow/brilho branco no número ao terminar a animação do contador (~300ms de duração)
- Separadores: linha vertical fina branca semi-opaca entre os 3 blocos
- Sem scale-up ou outros efeitos adicionais
- Textos mantidos exatamente como estão no hero atual:
  - 300+ → "projetos entregues"
  - R$ 79 Mi+ → "em mídia gerenciada"
  - R$ 210 Mi+ → "faturados"
- Labels: curtas e diretas, sem ícones, sem uppercase com tracking
- Fonte dos números: grande e impactante — 5xl mobile, 7xl/8xl desktop

### Claude's Discretion
- Padding/espaçamento interno da seção
- Easing da animação do glow
- Comportamento mobile dos separadores (podem virar horizontais ou sumir)
- Opacidade exata da linha separadora

### Deferred Ideas (OUT OF SCOPE)
- Nenhuma ideia fora de escopo surgiu durante a discussão
</user_constraints>

---

<phase_requirements>
## Phase Requirements

| ID | Description | Research Support |
|----|-------------|-----------------|
| SEC-03 | Seção de números/resultados com destaque visual melhorado (before/after ou transformação) | A seção dedicada com fundo #ff2a2a, grid 3 colunas, counters animados e glow de conclusão implementa este requisito completamente. |
</phase_requirements>

---

## Summary

Esta fase tem escopo cirúrgico: um único requisito pendente (SEC-03), que consiste em criar uma seção de números com destaque visual fora do hero. Todo o restante da Fase 2 (DSN-02, DSN-03, SEC-01, SEC-02) já foi implementado na Fase 1.

O trabalho envolve três operações no `index.html`: (1) remover o bloco de contadores do hero, (2) inserir a nova `<section>` com fundo vermelho entre o hero e a seção de logos, e (3) adicionar o efeito de glow CSS ao término da animação do contador. O sistema de contador JS (`.counter` + `data-target` + `data-suffix`) e o sistema de animação de entrada (`.fade-up` + IntersectionObserver) já estão em produção — serão reaproveitados sem modificação.

A principal decisão técnica não trivial é o efeito de glow branco no número ao finalizar a contagem. Isso requer uma `@keyframes` CSS nova e uma modificação de 1-2 linhas na função `animateCounter` existente para aplicar a classe ao finalizar o intervalo.

**Primary recommendation:** Uma única tarefa de edição direta no `index.html`. Sem novas dependências, sem novo JS framework, sem build step.

---

## Standard Stack

### Core (projeto existente — sem adições necessárias)

| Tecnologia | Versão/Fonte | Papel nesta fase | Status |
|-----------|-------------|-----------------|--------|
| HTML puro | — | Estrutura da nova seção | Existente |
| Tailwind CSS CDN | `cdn.tailwindcss.com` | Utilitários de layout (grid, padding, text size) | Existente |
| CSS custom (no `<style>`) | — | Tokens de cor, `.fade-up`, `.counter`, nova `.counter-glow` | Existente + extensão mínima |
| IntersectionObserver API | nativo browser | Disparar `.fade-up` e `animateCounter` na viewport | Existente |
| JavaScript inline (no `<script>`) | — | `animateCounter`, adicionar classe glow ao finalizar | Existente + 3-4 linhas |

Nenhuma dependência nova será instalada. O projeto é HTML estático sem build tool.

---

## Architecture Patterns

### Estrutura do arquivo index.html após a fase

```
<body>
  <header>...</header>                         <!-- fixo, inalterado -->
  <section id="hero">                          <!-- MODIFICADO: bloco grid-cols-3 removido -->
    ...hero copy, form...
  </section>
  <section id="numeros">                       <!-- NOVO: seção vermelha com 3 contadores -->
    ...grid 3 cols, contadores, glow...
  </section>
  <section class="logos-clientes">             <!-- inalterado — vem logo depois -->
    ...
  </section>
  ...restante da página inalterado...
  <style>                                      <!-- MODIFICADO: +@keyframes counter-glow -->
  <script>                                     <!-- MODIFICADO: +classList.add ao fim do counter -->
```

### Pattern 1: Remoção do bloco de contadores do hero

**O que remover** (linhas 143–158 do `index.html` atual):
```html
<!-- REMOVER este bloco inteiro do hero -->
<div class="grid grid-cols-3 gap-4 pt-6 border-t border-gray-800 fade-up delay-3">
    <div>
        <span class="block text-2xl lg:text-3xl font-black v4-red">
            <span class="counter" data-target="300" data-suffix="+">300+</span>
        </span>
        <span class="text-xs text-gray-400 uppercase font-bold">Projetos</span>
    </div>
    <div>
        <span class="block text-2xl lg:text-3xl font-black v4-red">R$ <span class="counter" data-target="79" data-suffix=" Mi+">79 Mi+</span></span>
        <span class="text-xs text-gray-400 uppercase font-bold">Investidos</span>
    </div>
    <div>
        <span class="block text-2xl lg:text-3xl font-black v4-red">R$ <span class="counter" data-target="210" data-suffix=" Mi+">210 Mi+</span></span>
        <span class="text-xs text-gray-400 uppercase font-bold">Faturados</span>
    </div>
</div>
```

### Pattern 2: Nova seção com fundo vermelho

**Ponto de inserção:** entre `</section>` (fim do hero, linha ~221) e `<!-- ══ LOGOS CLIENTES ══ -->` (linha ~223).

**Estrutura da seção:**
```html
<!-- ══ NÚMEROS / RESULTADOS ══ -->
<section id="numeros" class="v4-bg-red py-16 md:py-20 fade-up">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <p class="text-white/70 text-xs font-bold uppercase tracking-widest mb-10">
            Resultados que falam por si
        </p>
        <div class="grid grid-cols-3 gap-0 relative">

            <!-- Bloco 1 -->
            <div class="px-6 md:px-10 py-4">
                <p class="text-5xl md:text-7xl lg:text-8xl font-black text-white leading-none">
                    <span class="counter" data-target="300" data-suffix="+">300+</span>
                </p>
                <p class="text-white/80 text-sm md:text-base font-semibold mt-2">projetos entregues</p>
            </div>

            <!-- Separador vertical (some no mobile) -->
            <div class="hidden sm:block absolute left-1/3 top-0 bottom-0 w-px bg-white/20"></div>

            <!-- Bloco 2 -->
            <div class="px-6 md:px-10 py-4">
                <p class="text-5xl md:text-7xl lg:text-8xl font-black text-white leading-none">
                    R$ <span class="counter" data-target="79" data-suffix=" Mi+">79 Mi+</span>
                </p>
                <p class="text-white/80 text-sm md:text-base font-semibold mt-2">em mídia gerenciada</p>
            </div>

            <!-- Separador vertical -->
            <div class="hidden sm:block absolute left-2/3 top-0 bottom-0 w-px bg-white/20"></div>

            <!-- Bloco 3 -->
            <div class="px-6 md:px-10 py-4">
                <p class="text-5xl md:text-7xl lg:text-8xl font-black text-white leading-none">
                    R$ <span class="counter" data-target="210" data-suffix=" Mi+">210 Mi+</span>
                </p>
                <p class="text-white/80 text-sm md:text-base font-semibold mt-2">faturados</p>
            </div>

        </div>
    </div>
</section>
```

**Notas de implementação:**
- `v4-bg-red` já existe no CSS (`background-color: #ff2a2a`)
- Os separadores usam `absolute` positioning dentro do `grid` container com `relative`
- `hidden sm:block` garante que os separadores somem em mobile (comportamento delegado ao discretion do Claude)
- O `<section>` tem classe `fade-up` para herdar a animação de entrada já implementada

### Pattern 3: Efeito de glow ao terminar o contador

**Adição ao CSS** (dentro do `<style>` existente, após `.counter`):
```css
/* ── Counter glow (fim da animação) ── */
@keyframes counter-glow {
    0%   { text-shadow: 0 0 0px rgba(255,255,255,0); }
    40%  { text-shadow: 0 0 18px rgba(255,255,255,0.85), 0 0 36px rgba(255,255,255,0.4); }
    100% { text-shadow: 0 0 0px rgba(255,255,255,0); }
}
.counter-glow-active {
    animation: counter-glow 0.6s ease-out forwards;
}
```

**Modificação no JS** (função `animateCounter`, acrescentar 2 linhas no bloco do `clearInterval`):
```javascript
function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    const suffix = el.dataset.suffix || '';
    const duration = 1600;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            current = target;
            clearInterval(timer);
            // NOVO: acionar glow ao finalizar
            el.classList.add('counter-glow-active');
        }
        el.textContent = Math.floor(current) + suffix;
    }, 16);
}
```

O `prefers-reduced-motion` global já no CSS (`animation-duration: 0.01ms !important`) desativa automaticamente o `counter-glow` sem nenhuma modificação adicional.

### Anti-Patterns a Evitar

- **Não duplicar o IntersectionObserver:** O `counterObserver` já existente no script detecta `.counter` pelo `querySelectorAll` — os novos elementos `.counter` na seção vermelha serão capturados automaticamente porque o seletor é global. Não criar um segundo observer.
- **Não usar `text-red-*` do Tailwind na seção vermelha:** Os números devem ser `text-white`, não vermelhos sobre vermelho. O destaque vem do fundo, não da cor dos números.
- **Não remover o `border-t border-gray-800` do hero sem remover também o bloco de contadores:** São parte do mesmo `<div>` — remover o bloco inteiro de uma vez.
- **Não usar `position: relative` no `<section>` para os separadores:** O `relative` deve ficar no container `<div class="grid">` para que os `absolute` dos separadores se ancorem ao grid, não à seção inteira.

---

## Don't Hand-Roll

| Problema | Não Construir | Usar em vez | Razão |
|----------|--------------|-------------|-------|
| Animação de entrada na nova seção | Novo observer ou CSS custom | Classe `.fade-up` existente | Já implementado, já testa `prefers-reduced-motion` |
| Disparo do contador | Novo listener de scroll | `counterObserver` existente | O seletor `querySelectorAll('.counter')` captura os novos elementos automaticamente |
| Glow sutil | Canvas, WebGL, bibliotecas externas | `text-shadow` via `@keyframes` CSS | 4 linhas de CSS nativo; sem dependência |

---

## Common Pitfalls

### Pitfall 1: Separadores verticais em grid com overflow

**O que dá errado:** Usar `border-left` no segundo e terceiro `<div>` direto causa overflow quando o grid tem padding ou gap. A linha fica desalinhada.
**Por que acontece:** `border-left` respeita o box-model do elemento, mas o gap do grid cria espaço entre as bordas e os limites visuais.
**Como evitar:** Usar elementos separadores `absolute` dentro de um container `relative`, como descrito no Pattern 2. Ou usar `divide-x divide-white/20` do Tailwind (utilitário de divisória), que aplica `border-left` nos filhos exceto o primeiro.
**Aviso:** Se o visual parecer desalinhado no DevTools, verificar se o `relative` está no container do grid, não no `<section>`.

### Pitfall 2: `.counter-glow-active` não desaparece entre reinicializações

**O que dá errado:** Se o usuário navegar, sair e voltar para a seção (Single Page), o glow não re-executa porque a classe já está no elemento e o `counterObserver` não re-observa.
**Por que acontece:** `counterObserver.unobserve(entry.target)` impede que o contador reanime — comportamento intencional para contadores. A classe CSS fica persistente.
**Como evitar:** Não é problema para esta landing page (page-reload clássico, sem SPA). Ignorar.

### Pitfall 3: Fonte muito grande quebra em mobile

**O que dá errado:** `text-8xl` (6rem) com "R$ 210 Mi+" em 3 colunas em tela de 375px causa quebra de linha feia.
**Por que acontece:** O prefixo "R$ " mais o número mais o sufixo "Mi+" não cabem em 1/3 de 375px com font-size de 6rem.
**Como evitar:** Usar `text-5xl` em mobile (conforme decisão do usuário), escalando para `text-7xl md:text-8xl` apenas a partir de `md`. O sufixo "Mi+" pode precisar de `whitespace-nowrap` no span para não quebrar entre o número e o sufixo.

### Pitfall 4: `v4-bg-red` sem contraste suficiente para acessibilidade

**O que verificar:** #ff2a2a (fundo) com `text-white` — relação de contraste. A relação #ff2a2a / #ffffff é aproximadamente 3.8:1, que passa WCAG AA para texto grande (>= 18pt ou 14pt bold), que é exatamente o caso dos números gigantes. Para os labels menores (`text-sm`), o contraste pode ser insuficiente se usar `text-white/80` (opacidade reduzida). Usar `text-white` puro nos labels para garantir.

---

## Code Examples

### Separadores com Tailwind divide (alternativa mais simples)

```html
<!-- Alternativa ao absolute: usar divide-x do Tailwind -->
<div class="grid grid-cols-3 divide-x divide-white/20">
    <div class="px-8 py-4">...</div>
    <div class="px-8 py-4">...</div>
    <div class="px-8 py-4">...</div>
</div>
```

`divide-x` aplica `border-left-width: 1px` em todos os filhos exceto o primeiro. No mobile, substituir por `divide-x-0 sm:divide-x` para remover as linhas em telas pequenas. Esta é a abordagem mais simples e sem posicionamento absoluto.

### Glow com easing mais suave (cubic-bezier)

```css
@keyframes counter-glow {
    0%   { text-shadow: none; }
    30%  { text-shadow: 0 0 20px rgba(255,255,255,0.9), 0 0 40px rgba(255,255,255,0.3); }
    100% { text-shadow: none; }
}
.counter-glow-active {
    animation: counter-glow 0.65s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}
```

### Confirmação de que o IntersectionObserver captura os novos elementos

O seletor `document.querySelectorAll('.counter')` está no script inline no final do `<body>`. Por ser executado após o DOM completo, qualquer `.counter` no `index.html` — incluindo os da nova seção — é capturado sem modificação no JS.

---

## State of the Art

| Abordagem antiga | Abordagem atual neste projeto | Impacto |
|-----------------|-------------------------------|---------|
| `scroll` event listener com throttle | `IntersectionObserver` (nativo) | Performance melhor, sem cálculo manual de offset |
| `setTimeout` para animações | `@keyframes` CSS + `animation` | GPU-accelerated, respeita `prefers-reduced-motion` via media query |
| Números no hero misturados com copy | Seção dedicada com identidade visual própria | Maior impacto visual, hero mais limpo |

---

## Open Questions

1. **Labels dos números: "projetos entregues" vs "Projetos" (hero atual)**
   - O que sabemos: o hero usa "Projetos", "Investidos", "Faturados" (curto, uppercase). O CONTEXT.md pede labels exatas: "projetos entregues", "em mídia gerenciada", "faturados".
   - O que está claro: usar os textos do CONTEXT.md — são mais descritivos e adequados para uma seção de destaque maior.
   - Recomendação: usar as labels do CONTEXT.md na nova seção. O hero será removido junto com suas labels curtas.

2. **Opacidade dos separadores no mobile**
   - O que sabemos: a decisão foi delegada ao Claude's Discretion — "podem virar horizontais ou sumir".
   - Recomendação: sumir no mobile (`hidden sm:block` ou `divide-x-0 sm:divide-x`) é a opção mais limpa. Separadores horizontais em stack vertical são raramente usados e podem parecer regras de divisão de parágrafo.

---

## Sources

### Primary (HIGH confidence)
- Inspeção direta de `index.html` (linhas 1-637) — código existente confirmado
- `.planning/phases/02-enriquecimento-animacoes-conteudo/02-CONTEXT.md` — decisões travadas
- MDN IntersectionObserver API — padrão nativo, sem dependências externas
- MDN `text-shadow` + `@keyframes` — CSS nativo, suporte universal

### Secondary (MEDIUM confidence)
- Tailwind CSS `divide-x` utility — documentação oficial Tailwind v3 (`divide-width`, `divide-color`)
- WCAG 2.1 contrast ratio calculator — #ff2a2a vs #ffffff = ~3.8:1 (passa AA para texto grande)

### Tertiary (LOW confidence)
- Nenhum achado de baixa confiança nesta pesquisa

---

## Metadata

**Confidence breakdown:**
- Standard stack: HIGH — zero dependências novas, tudo confirmado no código existente
- Architecture: HIGH — padrões de remoção/inserção mapeados com números de linha exatos
- Pitfalls: HIGH — identificados por análise direta do código, não por suposição

**Research date:** 2026-03-25
**Valid until:** 2026-06-25 (stack estático, sem versões de biblioteca para expirar)
