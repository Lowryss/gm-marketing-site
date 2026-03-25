---
plan: 03
phase: 1
wave: 2
title: WhatsApp Flutuante + CTAs Intermediários + prefers-reduced-motion
depends_on: ["01", "02"]
files_modified: ["index.html"]
autonomous: true
requirements: ["WPP-01", "WPP-03", "DSN-05", "PERF-01"]
---

# Plan 03 — WhatsApp Flutuante + CTAs + prefers-reduced-motion

## Goal
Botão WhatsApp fixo com pulso, CTAs intermediários após depoimentos e metodologia, e suporte completo a prefers-reduced-motion.

## Tasks

<task id="1.3.1">
Adicionar botão WhatsApp flutuante fixo antes do `</body>`:
```html
<a href="https://wa.me/5511999999999?text=Ol%C3%A1%21+Vi+o+site+da+GM+Marketing"
   target="_blank" rel="noopener"
   class="whatsapp-float fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 bg-green-500 hover:bg-green-600 rounded-full shadow-lg cursor-pointer transition-colors duration-200"
   aria-label="Falar no WhatsApp">
  <!-- SVG WhatsApp icon inline -->
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-white">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.116 1.528 5.847L.057 23.5l5.797-1.522A11.934 11.934 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.89 0-3.655-.52-5.17-1.426l-.37-.22-3.44.903.918-3.352-.241-.386A9.937 9.937 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
  </svg>
</a>
```

Adicionar ao `<style>`:
```css
.whatsapp-float { animation: pulse-green 2s infinite; }
@keyframes pulse-green {
  0%, 100% { box-shadow: 0 0 0 0 rgba(34,197,94,0.4); }
  50% { box-shadow: 0 0 0 10px rgba(34,197,94,0); }
}
@media (prefers-reduced-motion: reduce) {
  .whatsapp-float { animation: none; }
}
```
</task>

<task id="1.3.2">
Adicionar CTA intermediário após a seção de depoimentos (antes da seção de metodologia):
```html
<div class="text-center py-4">
  <a href="#form" class="inline-block v4-bg-red text-white font-black uppercase py-3 px-8 hover:bg-red-700 transition tracking-wider rounded cursor-pointer">
    Quero Meu Diagnóstico Gratuito
  </a>
</div>
```
</task>

<task id="1.3.3">
Adicionar CTA intermediário após a seção de metodologia (antes do footer CTA):
```html
<div class="text-center mt-12">
  <a href="#form" class="inline-block border-2 border-red-500 text-red-400 font-black uppercase py-3 px-8 hover:bg-red-500 hover:text-white transition tracking-wider rounded cursor-pointer">
    Falar com um Especialista
  </a>
</div>
```
</task>

<task id="1.3.4">
Adicionar ao `<style>` a regra global de prefers-reduced-motion:
```css
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
```
</task>

<task id="1.3.5">
Nos dois vídeos, garantir `preload="metadata"` (já existe, verificar) e que o atributo `poster` está definido. Substituir os posters Unsplash por um placeholder de cor sólida se não carregar:
Adicionar `onerror` no poster ou manter os Unsplash existentes — verificar se carregam corretamente.
</task>

## Verification

- [ ] Botão verde WhatsApp aparece fixo no canto inferior direito
- [ ] Botão pulsa suavemente (animação)
- [ ] Dois CTAs intermediários visíveis na página
- [ ] `prefers-reduced-motion` no CSS global presente
- [ ] Vídeos têm `preload="metadata"`

## must_haves
- Botão WhatsApp sempre visível durante scroll
- `cursor-pointer` em todos os elementos clicáveis novos
- Animações respeitam prefers-reduced-motion
