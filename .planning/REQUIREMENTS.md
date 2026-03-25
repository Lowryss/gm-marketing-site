# Requirements: GM Marketing Landing Page

**Defined:** 2026-03-25
**Core Value:** Visitante preenche formulário e entra em contato via WhatsApp com assessor GM

## v1 Requirements

### Design System & Visual

- [ ] **DSN-01**: Substituir emojis (📉💸😴📊) por SVG icons inline (Heroicons/Lucide) nos cards de dores
- [ ] **DSN-02**: Aplicar animações de entrada scroll-triggered (fade-up com IntersectionObserver) em todas as seções
- [ ] **DSN-03**: Implementar contador animado nos números do hero (300+, R$79M+, R$210M+) ao entrar na viewport
- [ ] **DSN-04**: Corrigir contraste de texto — body text mínimo text-gray-300, muted mínimo text-gray-400
- [ ] **DSN-05**: Adicionar `prefers-reduced-motion` em todas as animações CSS e JS

### Formulário & Conversão

- [ ] **FORM-01**: Formulário exibe loading state no botão ao submeter (desabilitar botão + spinner)
- [ ] **FORM-02**: Após submit válido, redirecionar para WhatsApp com mensagem pré-preenchida (nome + faturamento)
- [ ] **FORM-03**: Formulário exibe mensagem de sucesso inline antes do redirect WhatsApp
- [ ] **FORM-04**: Todos os campos do formulário têm `<label>` associado (visível ou sr-only)
- [ ] **FORM-05**: Validação inline com feedback visual em campo inválido (borda vermelha + mensagem)

### WhatsApp & CTA

- [ ] **WPP-01**: Botão WhatsApp flutuante fixo (canto inferior direito) com ícone SVG e animação de pulso
- [ ] **WPP-02**: Número real da GM Marketing configurado no wa.me link (formulário + botão flutuante)
- [ ] **WPP-03**: CTAs intermediários adicionados após seção de depoimentos e após metodologia

### Seções de Conteúdo

- [ ] **SEC-01**: Seção FAQ com 5-6 perguntas/respostas sobre objeções comuns (preço, prazo, resultados)
- [ ] **SEC-02**: Cards de depoimentos textuais (3 cards com foto placeholder, nome, empresa e resultado específico)
- [x] **SEC-03**: Seção de números/resultados com destaque visual melhorado (before/after ou transformação)

### Performance & Acessibilidade

- [ ] **PERF-01**: Vídeos com `preload="metadata"` e `poster` image definida (já tem poster via Unsplash)
- [ ] **PERF-02**: Fontes Google com `display=swap` (já tem, verificar)
- [ ] **A11Y-01**: `scroll-behavior: smooth` no elemento `html`

### SEO

- [ ] **SEO-01**: Meta tags OG completas (og:title, og:description, og:image 1200x630)
- [ ] **SEO-02**: Meta description e title otimizados para busca
- [ ] **SEO-03**: `lang="pt-BR"` e charset corretos (já tem, verificar)

## v2 Requirements (deferred)

### Extras pós-lançamento
- **V2-01**: Schema markup LocalBusiness para SEO local
- **V2-02**: Seção de vagas/escassez ("Atendemos X empresas/mês — Y vagas restantes")
- **V2-03**: Google Analytics / Meta Pixel integrado
- **V2-04**: A/B test de headline principal
- **V2-05**: Versão em inglês da página

## Out of Scope

| Feature | Razão |
|---------|-------|
| Backend/servidor | Página estática — sem servidor |
| CRM automático | Integração futura, fora do MVP |
| Chat bot | Anti-feature — distrai do formulário |
| Área logada / painel | Não é LP, é produto diferente |
| Versão mobile app | Web-first |

## Traceability

| Requirement | Phase | Status |
|-------------|-------|--------|
| DSN-01, DSN-04, DSN-05 | Phase 1 | Pending |
| DSN-02, DSN-03 | Phase 2 | Pending |
| FORM-01–05 | Phase 1 | Pending |
| WPP-01–03 | Phase 1 | Pending |
| SEC-01–03 | Phase 2 | Pending |
| PERF-01–02, A11Y-01 | Phase 1 | Pending |
| SEO-01–03 | Phase 3 | Pending |

**Coverage:**
- v1 requirements: 22 total
- Mapped to phases: 22
- Unmapped: 0 ✓

---
*Requirements defined: 2026-03-25*
*Last updated: 2026-03-25 after initialization*
