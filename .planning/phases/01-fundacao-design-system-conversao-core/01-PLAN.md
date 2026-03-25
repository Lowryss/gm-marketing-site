---
plan: 01
phase: 1
wave: 1
title: SVG Icons + Contraste + Scroll Smooth
depends_on: []
files_modified: ["index.html"]
autonomous: true
requirements: ["DSN-01", "DSN-04", "A11Y-01"]
---

# Plan 01 — SVG Icons + Contraste + Scroll Smooth

## Goal
Substituir todos os emojis por SVG icons inline, corrigir contraste de texto para WCAG AA e adicionar scroll suave.

## Tasks

<task id="1.1.1">
Adicionar `scroll-behavior: smooth` ao seletor `html` no `<style>` do index.html.
</task>

<task id="1.1.2">
Na seção de dores (#problema), substituir os 4 emojis (📉 💸 😴 📊) por SVGs inline do Heroicons. Usar ícones:
- 📉 → `arrow-trending-down` (SVG path heroicons)
- 💸 → `banknotes`
- 😴 → `pause-circle`
- 📊 → `chart-bar`

SVG inline: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-red-500">...</svg>`
</task>

<task id="1.1.3">
Corrigir contraste de texto em toda a página:
- Todos os `text-gray-500` em parágrafos de cards → trocar para `text-gray-300`
- `text-gray-400` em parágrafos de body → manter (WCAG AA em dark #111)
- Verificar seção de metodologia: parágrafos com `text-gray-400` → `text-gray-300`
</task>

## Verification

- [ ] Nenhum emoji visível na página (inspecionar HTML)
- [ ] SVGs renderizando com cor `text-red-500` nos cards de dores
- [ ] Parágrafos de cards usando mínimo `text-gray-300`
- [ ] Link de âncora `#form` faz scroll suave

## must_haves
- Emojis removidos e substituídos por SVG
- Contraste mínimo text-gray-300 em body text de cards
