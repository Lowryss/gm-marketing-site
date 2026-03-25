# Design System — GM Marketing (UI Pro Max Output)

## Padrão de Conversão Recomendado

**Pattern:** Before-After Transformation
- Seções: Hero (estado do problema) → Comparação/Transformação → Como funciona → Resultados → CTA
- Foco: Prova visual de valor. +45% conversão com métricas reais e garantia.
- CTA: Após revelação da transformação + Bottom

**Style:** Motion-Driven
- Animation-heavy, microinterações, scroll effects, animações de entrada, parallax leve
- Atenção: `prefers-reduced-motion` obrigatório

## Paleta — ADAPTAR À MARCA GM

> UI Pro Max sugeriu pink/cyan, mas a identidade GM é vermelho #ff2a2a em dark mode.
> Manter a paleta de marca com os princípios de contraste recomendados.

| Role | Hex GM (manter) | Princípio |
|------|-----------------|-----------|
| Primary (CTA/destaque) | #ff2a2a | Vermelho agressivo de performance |
| Background | #0a0a0a / #111111 | Dark mode profundo |
| Text | #ffffff | Máximo contraste |
| Text muted | #6b7280 (gray-500) | Mínimo gray-400 |
| Border | #1f2937 (gray-800) | Visível em dark mode |
| Card | #111111 | 1 nível acima do BG |

## Tipografia Recomendada (upgrade)

**Opção A — Manter Montserrat** (sem mudança de fonte)
- Seguro, já carregado, familiar à marca

**Opção B — Upgrade para Oswald + Inter** (recomendado para marketing agressivo)
- Heading: Oswald (compact, bold, impactante — padrão agências performance BR)
- Body: Inter (legibilidade máxima, 16px+)

```css
@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Inter:wght@400;500;600&display=swap');
```

## Estrutura de Seções (Landing Page)

Ordem validada por UI Pro Max para lead capture + social proof:

1. **Hero** — Headline problema + Formulário (acima da dobra)
2. **Social proof rápido** — Logos de clientes (credibilidade imediata)
3. **Problema/Dores** — Agitar o problema (PAS: Problem-Agitate-Solution)
4. **Transformação** — Before/After com números reais (300+ projetos, R$210M+)
5. **Prova social** — Depoimentos em vídeo + cards de texto com resultados
6. **Metodologia** — Como funciona (3 etapas)
7. **FAQ** — Objeções comuns (confiança)
8. **CTA Final** — Vermelho, urgência, repetir formulário ou botão WhatsApp

## Efeitos e Animações

```css
/* Entrada scroll-triggered */
.fade-up {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}
.fade-up.visible {
  opacity: 1;
  transform: translateY(0);
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
  .fade-up { opacity: 1; transform: none; transition: none; }
}
```

```javascript
// Intersection Observer
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.15 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
```

## UX Guidelines Aplicáveis

- `scroll-behavior: smooth` no `html` element
- Formulário: feedback de loading → sucesso/erro após submit
- Inputs: `<label>` associado (não só placeholder)
- Sem scroll horizontal em mobile: `overflow-x-hidden` no body
- Animações decorativas: evitar `animate-bounce` infinito em ícones
- Tailwind placeholders: `placeholder:text-gray-400`

## Stack html-tailwind

- Dark mode: `dark:bg-gray-900 dark:text-white` (ou classes fixas para LP sem toggle)
- Tailwind v3 CDN já usa JIT por padrão
- Placeholders: `placeholder:text-gray-400`
