# Architecture Research — GM Marketing Landing Page

## Estrutura HTML Recomendada

Página única (one-page) com âncoras. Fluxo PASTOR (Problem → Amplify → Solution → Transformation → Offer → Response):

```
index.html
├── <head> — meta, og, fonts, tailwind cdn
├── <header> — navbar fixo (logo + CTA)
├── <main>
│   ├── #hero — headline + formulário (above the fold)
│   ├── #logos — prova social rápida (logos clientes)
│   ├── #problema — dores em cards (agitar problema)
│   ├── #transformacao — números + before/after
│   ├── #depoimentos — vídeos + cards textuais
│   ├── #metodologia — 3 etapas do processo GM
│   ├── #faq — objeções respondidas
│   └── #cta — CTA final + formulário repetido (ou link WhatsApp)
├── <footer> — legal, contato, horário
└── <button id="whatsapp-float"> — botão flutuante fixo
```

## Ordem de Persuasão (PASTOR Framework)

1. **Problem (Hero)** — "Likes não pagam contas. Vendas pagam."
2. **Amplify (Dores)** — 4 cards de dores: sem previsibilidade, dinheiro queimado, time parado, foco na vaidade
3. **Solution (Transformação)** — Números: 300+ projetos, R$79M+ investidos, R$210M+ faturados
4. **Testimonials (Prova)** — Vídeos reais + cards com resultados específicos
5. **Offer (Metodologia)** — Como a GM resolve em 3 etapas
6. **Response (CTA)** — Diagnóstico gratuito + formulário/WhatsApp

## Organização de CSS no `<style>`

```css
/* 1. Variables & Tokens */
:root { --red: #ff2a2a; --bg: #0a0a0a; --card: #111; }

/* 2. Base */
body { ... }

/* 3. Layout helpers */
.section { ... }
.container { max-width: 1200px; margin: auto; padding: 0 1rem; }

/* 4. Components */
.btn-primary { ... }
.card { ... }
.form-input { ... }

/* 5. Animations */
.fade-up { ... }
@media (prefers-reduced-motion: reduce) { ... }
```

## Padrão de JavaScript Inline

Sem framework. JS vanilla no final do `<body>`:

```javascript
// 1. Scroll animations (IntersectionObserver)
// 2. Counter animation para números (300+, R$79M+)
// 3. Form submit → WhatsApp redirect
// 4. WhatsApp float button
```

## Convenções de Código

- Classes Tailwind: componentes repetidos extraídos como classes CSS com `@apply` NO `<style>` (não no CDN)
- IDs para âncoras de navegação (`#form`, `#depoimentos`, etc.)
- Classes `.fade-up` para elementos com animação de entrada
- Comentários de seção: `<!-- SECTION: HERO -->`
