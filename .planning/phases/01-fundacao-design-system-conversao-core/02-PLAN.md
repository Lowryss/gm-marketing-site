---
plan: 02
phase: 1
wave: 1
title: Formulário — Labels, Validação, Loading + WhatsApp Redirect
depends_on: []
files_modified: ["index.html"]
autonomous: true
requirements: ["FORM-01", "FORM-02", "FORM-03", "FORM-04", "FORM-05", "WPP-02"]
---

# Plan 02 — Formulário: Labels + Validação + WhatsApp Redirect

## Goal
Formulário com acessibilidade completa (labels), validação inline visual, loading state no submit e redirect para WhatsApp com mensagem pré-preenchida.

## Tasks

<task id="1.2.1">
Adicionar `<label class="sr-only" for="FIELD_ID">` para cada campo do formulário. Atribuir `id` e `name` únicos a cada input:
- `id="nome"` → label "Nome Completo"
- `id="email"` → label "E-mail Profissional"
- `id="whatsapp"` → label "WhatsApp"
- `id="faturamento"` → label "Faturamento Mensal" (no select)
</task>

<task id="1.2.2">
Adicionar validação inline com CSS e JS:
- Input inválido ao perder foco: borda `border-red-500` + mensagem `<span class="text-red-400 text-xs mt-1">Campo obrigatório</span>`
- Input válido: borda `border-green-500`
- Usar atributo `required` + pattern no WhatsApp: `pattern="[0-9]{10,11}"`
</task>

<task id="1.2.3">
Implementar loading state no botão de submit:
- Ao clicar: desabilitar botão + trocar texto para "Enviando..." + adicionar spinner SVG inline
- CSS para spinner: `animate-spin` Tailwind em SVG circle
</task>

<task id="1.2.4">
Implementar lógica de submit via JavaScript vanilla (no final do body):
```javascript
document.querySelector('form').addEventListener('submit', function(e) {
  e.preventDefault();
  const nome = document.getElementById('nome').value;
  const faturamento = document.getElementById('faturamento').value;
  // Mostrar mensagem de sucesso inline
  // Após 1.5s: redirect WhatsApp
  const numero = "5511999999999"; // SUBSTITUIR pelo número real da GM
  const msg = encodeURIComponent(`Olá! Vi o site da GM Marketing e quero um diagnóstico gratuito.\nNome: ${nome}\nFaturamento: ${faturamento}`);
  setTimeout(() => window.open(`https://wa.me/${numero}?text=${msg}`, '_blank'), 1500);
});
```
</task>

<task id="1.2.5">
Adicionar div de sucesso no formulário (oculta inicialmente):
```html
<div id="form-success" class="hidden text-center py-4">
  <p class="text-green-400 font-bold text-lg">✓ Recebemos seu contato!</p>
  <p class="text-gray-400 text-sm mt-1">Abrindo WhatsApp em instantes...</p>
</div>
```
JS: ao submeter com sucesso, ocultar form e mostrar este div antes do redirect.
</task>

## Verification

- [ ] Todos os campos têm label associado (sr-only ou visível)
- [ ] Campo inválido mostra borda vermelha e mensagem
- [ ] Botão de submit desabilita durante "envio"
- [ ] Mensagem de sucesso aparece antes do redirect
- [ ] Link wa.me tem número e mensagem pré-preenchida

## must_haves
- Submit não recarrega a página (preventDefault)
- WhatsApp abre em nova aba com mensagem contextualizada
- Formulário tem labels para todos os campos
