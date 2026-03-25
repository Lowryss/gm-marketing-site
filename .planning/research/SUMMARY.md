# Research Summary — GM Marketing Landing Page

## Stack Recomendado

HTML + Tailwind CDN v3 + JS vanilla. Sem mudança de stack. Adicionar apenas:
- IntersectionObserver nativo para animações scroll
- `wa.me` redirect no submit do formulário
- SVG icons inline (Heroicons) substituindo emojis atuais

## Table Stakes (o que DEVE ter)

1. Formulário com feedback de submit + redirect WhatsApp
2. WhatsApp flutuante sempre visível
3. Labels em todos os campos do formulário
4. SVG icons (remover emojis 📉💸😴📊)
5. `prefers-reduced-motion` em todas as animações
6. Meta tags OG para compartilhamento
7. Vídeos com `preload="metadata"` + poster image
8. CTAs intermediários após depoimentos e metodologia

## Diferenciadoras para Implementar

1. Animações de entrada scroll-triggered (fade-up)
2. Contador animado nos números (300+, R$79M+, R$210M+)
3. Seção FAQ com objeções comuns
4. Cards de depoimentos textuais (além dos vídeos)
5. Tipografia upgrade (Oswald para headings — opcional)

## Pitfalls Prioritários

1. **Emojis como ícones** → Substituir por SVG (Fase 1)
2. **Formulário sem feedback** → Loading + WhatsApp redirect (Fase 1)
3. **Ausência de FAQ** → Objeções sem resposta queimam conversão (Fase 2)
4. **Sem meta OG** → Compartilhamentos sem preview (Fase 2)
5. **Contraste de texto** → gray-500 abaixo do mínimo WCAG (Fase 1)

## Ordem de Fases Sugerida

- **Fase 1** — Design system aplicado + correções críticas (ícones, contraste, formulário, WhatsApp)
- **Fase 2** — Animações + contador + FAQ + depoimentos cards
- **Fase 3** — SEO/meta tags + performance (lazy load vídeos) + WhatsApp flutuante
