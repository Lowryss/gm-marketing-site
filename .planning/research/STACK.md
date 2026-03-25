# Stack Research — GM Marketing Landing Page

## Stack Atual (manter)

| Tecnologia | Versão | Uso |
|------------|--------|-----|
| HTML5 | — | Estrutura |
| Tailwind CSS CDN | v3 (JIT) | Styling |
| Google Fonts | — | Tipografia |
| JavaScript Vanilla | ES2020+ | Interatividade |
| Vercel | — | Deploy |

**Confiança: HIGH** — stack validada, sem dependências de build.

## Bibliotecas Complementares Recomendadas (CDN)

### Animações Scroll — Nenhuma biblioteca necessária
Usar **IntersectionObserver API** nativa (suporte 97%+ browsers).
Alternativa leve: **AOS.js** (2.3.4, 7KB gzip) se quiser configuração simplificada.
```html
<!-- AOS (opcional) -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
```

### Ícones SVG — Heroicons (inline)
Não usar biblioteca externa. Copiar SVGs inline do heroicons.com.
- Evita request adicional
- Tamanho controlado com `w-6 h-6`

### Contador Animado — Vanilla JS
Implementar counter animation nativo (~15 linhas JS). Não justifica biblioteca.

### Formulário → WhatsApp
```javascript
// Redirect após submit
const numero = "5511999999999"; // número GM
const msg = encodeURIComponent(`Olá! Vi o site da GM Marketing e quero um diagnóstico.\nNome: ${nome}\nEmpresa faturando: ${faturamento}`);
window.open(`https://wa.me/${numero}?text=${msg}`, '_blank');
```

## O que NÃO usar

| O que | Por quê evitar |
|-------|----------------|
| jQuery | Desnecessário para LP estática — +87KB |
| Bootstrap | Conflita com Tailwind, peso desnecessário |
| GSAP (gratuito) | Overkill para animações simples de LP |
| React/Vue/Svelte | LP estática não precisa de framework JS |
| Tailwind CLI/PostCSS | CDN já cobre tudo para LP estática |
| Sliders (Swiper, Splide) | Anti-feature — carrosséis prejudicam conversão |

## Performance Targets

| Métrica | Target | Como atingir |
|---------|--------|--------------|
| LCP | < 2.5s | Poster image nos vídeos, fonte `display=swap` |
| CLS | < 0.1 | Reservar espaço para vídeos com aspect-ratio |
| FID | < 100ms | JS no final do body, sem blocking |
| Mobile score | > 85 | Lazy load vídeos fora da dobra |
