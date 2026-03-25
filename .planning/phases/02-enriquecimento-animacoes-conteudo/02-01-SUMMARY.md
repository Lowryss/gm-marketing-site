---
phase: 02-enriquecimento-animacoes-conteudo
plan: 01
subsystem: ui
tags: [html, tailwind, css-animations, intersection-observer, counters]

# Dependency graph
requires:
  - phase: 01-fundacao
    provides: animateCounter function, counterObserver IntersectionObserver, .counter CSS class, .v4-bg-red brand token, .fade-up scroll animations

provides:
  - Seção #numeros com fundo #ff2a2a entre hero e logos clientes
  - Contadores animados (300+, R$79Mi+, R$210Mi+) em tamanho 5xl–8xl
  - Glow branco ao finalizar cada contagem (@keyframes counter-glow + .counter-glow-active)
  - Hero limpo — sem grid de contadores pequenos em vermelho

affects: [03-seo-performance]

# Tech tracking
tech-stack:
  added: []
  patterns:
    - "Reutilização de IntersectionObserver existente (querySelectorAll global captura novos .counter sem modificação do observer)"
    - "Tailwind divide-x para separadores verticais responsivos (some em mobile com divide-x-0 sm:divide-x)"
    - "whitespace-nowrap em números com prefixo para evitar quebra de linha em mobile"

key-files:
  created: []
  modified:
    - index.html

key-decisions:
  - "Usar divide-x do Tailwind em vez de separadores absolutos — mais simples, sem overflow issues e responsivo nativamente"
  - "Labels com text-white puro (não text-white/80) — contraste WCAG AA garantido sobre fundo #ff2a2a para texto pequeno"
  - "R$&nbsp; com non-breaking space — evita quebra entre prefixo e contador em qualquer viewport"
  - "Não criar segundo IntersectionObserver — counterObserver existente usa seletor global .counter e captura automaticamente os novos elementos"

patterns-established:
  - "Glow de conclusão: adicionar classe CSS via classList após clearInterval para feedback visual sem JS extra"

requirements-completed: [SEC-03]

# Metrics
duration: 8min
completed: 2026-03-25
---

# Phase 2 Plan 01: Seção de Números Summary

**Seção #numeros com fundo #ff2a2a inserida entre hero e logos, contadores animados 5xl–8xl com glow branco CSS ao finalizar, hero limpo sem grid de métricas pequenas**

## Performance

- **Duration:** 8 min
- **Started:** 2026-03-25T17:35:00Z
- **Completed:** 2026-03-25T17:43:32Z
- **Tasks:** 1 (+ 1 checkpoint auto-aprovado)
- **Files modified:** 1

## Accomplishments

- Remove o grid de contadores pequenos em vermelho do hero — hero fica mais limpo com foco em headline, sub e formulário
- Insere seção #numeros (v4-bg-red) com 3 blocos de números grandes brancos (300+, R$79Mi+, R$210Mi+) com separadores responsivos
- Adiciona efeito de glow branco sutil (0.65s, cubic-bezier) disparado ao finalizar cada contador via classList.add
- Reutiliza animateCounter e counterObserver existentes sem nenhuma modificação no observer — zero código duplicado

## Task Commits

Cada task foi commitada atomicamente:

1. **Task 1: Remover contadores do hero e inserir seção #numeros** - `3133f6a` (feat)

## Files Created/Modified

- `index.html` — 4 edições cirúrgicas: remoção do bloco hero (linhas 143–158), inserção da seção #numeros após o hero, adição de @keyframes counter-glow + .counter-glow-active no CSS, modificação de animateCounter para disparar glow

## Decisions Made

- Separadores verticais com `divide-x-0 sm:divide-x divide-white/20` no Tailwind em vez de pseudo-elementos absolutos — evita overflow, responsivo nativamente, e não requer `position: relative` na section
- Labels com `text-white` puro (não `text-white/80`) para garantir contraste WCAG AA sobre o fundo vermelho #ff2a2a em texto pequeno (sm/base)
- `R$&nbsp;` com non-breaking space — impede quebra de linha entre o prefixo "R$" e o valor do contador em qualquer viewport
- Não criar um segundo IntersectionObserver: o `counterObserver` existente usa `document.querySelectorAll('.counter')` como seletor global e captura automaticamente os novos elementos da seção #numeros

## Deviations from Plan

None - plano executado exatamente como especificado.

## Issues Encountered

None.

## User Setup Required

None - no external service configuration required.

## Next Phase Readiness

- Seção #numeros pronta e funcional com contadores animados e glow de conclusão
- Hero mais limpo — sem duplicação de métricas
- Pronto para executar próximo plano da fase 02 (02-02)

## Self-Check: PASSED

- index.html: FOUND
- 02-01-SUMMARY.md: FOUND
- commit 3133f6a: FOUND

---
*Phase: 02-enriquecimento-animacoes-conteudo*
*Completed: 2026-03-25*
