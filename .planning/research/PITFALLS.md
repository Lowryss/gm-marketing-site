# Pitfalls Research — GM Marketing Landing Page

## Pitfalls Críticos

### 1. Formulário sem feedback de submit
**Sinal:** Botão clicado, nada acontece visualmente por 1-2s
**Prevenção:** Loading state no botão → mensagem de sucesso → redirect WhatsApp em 1.5s
**Fase:** Fase 1 (formulário)

### 2. Vídeos bloqueando LCP no mobile
**Sinal:** Página lenta em 3G, vídeo carrega antes de qualquer texto
**Prevenção:** `preload="metadata"` + poster image estática + lazy load em vídeos fora da dobra
**Fase:** Fase 2 (performance)

### 3. Emojis como ícones UI (já presente no index.html atual)
**Sinal:** `📉`, `💸`, `😴`, `📊` como ícones de cards
**Prevenção:** Substituir por SVG inline (Heroicons ou Lucide) — emojis renderizam diferente por OS/browser
**Fase:** Fase 1 (design system)

### 4. Formulário com só placeholder, sem label
**Sinal:** Campo de input sem `<label>` associado
**Prevenção:** Labels visíveis ou `<label class="sr-only">` + `for` attribute
**Fase:** Fase 1 (acessibilidade)

### 5. CTA genérico "Enviar" ou "Clique aqui"
**Sinal:** Botão de submit sem copy de ação específica
**Prevenção:** Copy específico: "Quero Meu Diagnóstico Gratuito" — descreve o que acontece após clicar
**Fase:** Fase 1 (copy)

### 6. Ausência de meta tags OG
**Sinal:** Compartilhamento no WhatsApp/redes mostra texto genérico sem imagem
**Prevenção:** `og:title`, `og:description`, `og:image` (1200x630px)
**Fase:** Fase 2 (SEO)

### 7. Sem número de WhatsApp real
**Sinal:** CTA de WhatsApp usa link `#` ou número placeholder
**Prevenção:** Obter o número real da GM e configurar `wa.me/55XXXXXXXXXXX?text=Mensagem`
**Fase:** Fase 1 (integração)

### 8. Animações sem `prefers-reduced-motion`
**Sinal:** Fade-ups e parallax ativos mesmo em usuários com vestibular disorder
**Prevenção:** Media query `@media (prefers-reduced-motion: reduce)` desativa todas as transições
**Fase:** Fase 1 (acessibilidade)

### 9. Cards de dores com texto em gray-500 em dark mode
**Sinal:** Texto de parágrafo em `text-gray-500` — contraste 3.5:1, abaixo do mínimo 4.5:1
**Prevenção:** Usar mínimo `text-gray-400` para texto secundário, `text-gray-300` para body
**Fase:** Fase 1 (contraste)

### 10. Seção de metodologia sem CTA intermediário
**Sinal:** Usuário convencido pela metodologia mas não tem onde clicar até o final
**Prevenção:** Adicionar botão de CTA após metodologia e após depoimentos (não só no final)
**Fase:** Fase 1 (conversão)
