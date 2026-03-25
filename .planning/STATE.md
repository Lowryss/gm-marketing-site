# Project State — GM Marketing Landing Page

## Project Reference

See: .planning/PROJECT.md (updated 2026-03-25)

**Core value:** Visitante preenche formulário → entra no WhatsApp da GM
**Current focus:** Phase 2 — Enriquecimento (animations, counters, FAQ done in Phase 1)

## Current Status

| Phase | Status | Plans | Progress |
|-------|--------|-------|----------|
| 1 — Fundação | ✓ Done | 3/3 | 100% |
| 2 — Animações | ◑ In Progress | 1/4 | 25% |
| 3 — SEO/Performance | ○ Pending | 0/2 | 0% |

## Phase 1 Deliverables

All requirements fulfilled in index.html:
- DSN-01: Emojis → Heroicons SVG ✓
- DSN-02: Fade-up scroll animations (IntersectionObserver) ✓
- DSN-03: Animated counters (300+, R$79M+, R$210M+) ✓
- DSN-04: Contrast text-gray-300 minimum ✓
- DSN-05: prefers-reduced-motion global CSS ✓
- FORM-01 to FORM-05: sr-only labels, inline validation, loading, WhatsApp redirect ✓
- WPP-01: WhatsApp float button with pulse animation ✓
- WPP-02: wa.me redirect with pre-filled message ✓
- WPP-03: 2 intermediate CTAs ✓
- SEC-01: FAQ accordion (5 Q&As, aria-expanded) ✓
- SEC-02: Text testimonial cards (3 depoimentos) ✓
- PERF-01: Videos with preload="metadata" ✓
- A11Y-01: scroll-behavior: smooth ✓
- SEO-01 to SEO-03: OG meta tags + SEO title/description ✓

## Phase 2 Deliverables (in progress)

- SEC-03: Seção #numeros com fundo #ff2a2a, contadores animados 5xl–8xl, glow branco ao finalizar ✓ (02-01)

## Last Action

Phase 2 Plan 01 executed — 2026-03-25
Commit: 3133f6a feat(02-01): seção #numeros com fundo vermelho e contadores animados

## Decisions

- divide-x Tailwind para separadores verticais (sem pseudo-elementos absolutos)
- text-white puro nos labels da seção #numeros para contraste WCAG AA sobre #ff2a2a
- Reutilizou counterObserver existente (seletor global) — zero código duplicado

## Next Step

Execute 02-02 — próximo plano da fase 02

## Pending

- **SUBSTITUIR número WhatsApp placeholder**: `5511999999999` → número real da GM Marketing
  (buscar em: index.html linha ~440, 2 ocorrências)
