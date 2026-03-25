# Roadmap: GM Marketing Landing Page

**Project:** GM Marketing Landing Page
**Milestone:** v1 — Landing Page de Alta Conversão
**Total Phases:** 3
**Requirements covered:** 22/22 ✓

---

## Phase 1 — Fundação: Design System + Conversão Core

**Goal:** O visitante consegue preencher o formulário e ser redirecionado para o WhatsApp da GM, com visual profissional (sem emojis, contraste correto, animações básicas).

**Requirements:** DSN-01, DSN-04, DSN-05, FORM-01, FORM-02, FORM-03, FORM-04, FORM-05, WPP-01, WPP-02, WPP-03, PERF-01, A11Y-01

**Success Criteria:**
1. Formulário submetido com dados válidos abre WhatsApp com mensagem pré-preenchida em nova aba
2. Botão de submit mostra loading e desabilita durante processamento
3. Nenhum emoji visível como ícone — substituídos por SVGs
4. Contraste de texto passa verificação WCAG AA (4.5:1 mínimo para body)
5. `prefers-reduced-motion` desativa transições quando ativado no OS

**Plans:**
- PLAN-1.1: Substituir emojis por SVGs + corrigir contraste (DSN-01, DSN-04)
- PLAN-1.2: Formulário com loading, validação, labels e redirect WhatsApp (FORM-01–05, WPP-02)
- PLAN-1.3: WhatsApp flutuante + CTAs intermediários + scroll smooth (WPP-01, WPP-03, A11Y-01)
- PLAN-1.4: prefers-reduced-motion + vídeos preload metadata (DSN-05, PERF-01)

---

## Phase 2 — Enriquecimento: Animações + Conteúdo

**Goal:** Seção dedicada de números/resultados com fundo vermelho GM, contador animado e glow de conclusão, destacada entre o hero e os logos de clientes.

**Requirements:** DSN-02, DSN-03, SEC-01, SEC-02, SEC-03

**Note:** DSN-02, DSN-03, SEC-01, SEC-02 foram antecipados na Fase 1 e estão concluídos. Apenas SEC-03 permanece pendente.

**Success Criteria:**
1. Seção #numeros com fundo #ff2a2a aparece imediatamente após o hero
2. Três contadores animam de 0 ao valor final ao entrar na viewport (300+, R$79Mi+, R$210Mi+)
3. Glow branco sutil aparece ao término de cada animação de contador (~0.6s)
4. Hero não exibe mais os contadores pequenos em vermelho
5. Animações não ocorrem quando `prefers-reduced-motion: reduce` está ativo

**Plans:** 1 plan

Plans:
- [ ] 02-01-PLAN.md — Seção #numeros: migrar contadores do hero, inserir seção vermelha com glow (SEC-03)

---

## Phase 3 — Polimento: SEO + Performance

**Goal:** A página está otimizada para compartilhamento e busca orgânica, com meta tags OG corretas e carregamento rápido.

**Requirements:** SEO-01, SEO-02, SEO-03, PERF-02

**Success Criteria:**
1. Compartilhamento no WhatsApp mostra preview com imagem, título e descrição da GM
2. `<title>` e `<meta description>` contêm palavras-chave relevantes (marketing digital, leads, ROI)
3. Google PageSpeed Insights mobile score > 80
4. Fontes carregam com `display=swap` sem FOUT perceptível

**Plans:**
- PLAN-3.1: Meta tags OG + title + description otimizados (SEO-01, SEO-02, SEO-03)
- PLAN-3.2: Performance check — fontes display=swap, imagens, lazy load vídeos fora da dobra (PERF-02)

---

## Summary

| # | Phase | Requirements | Plans |
|---|-------|-------------|-------|
| 1 | Fundação: Design System + Conversão | 13 | 4 |
| 2 | Enriquecimento: Animações + Conteúdo | 5 | 1 |
| 3 | Polimento: SEO + Performance | 4 | 2 |

**Total:** 22 requirements → 7 plans → 3 phases
