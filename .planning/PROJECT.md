# GM Marketing — Landing Page

## What This Is

Landing page de captação de leads para a GM Marketing, assessoria de marketing digital focada em resultados e ROI. A página converte visitantes (donos de empresas locais) em leads qualificados via formulário com envio para WhatsApp. Já existe um `index.html` funcional em versão V4 que será evoluído com a skill UI/UX Pro Max.

## Core Value

O visitante preenche o formulário e recebe contato de um assessor GM — cada lead gerado é uma oportunidade de negócio real.

## Requirements

### Validated

- ✓ Hero section com headline impactante e formulário de lead — existente
- ✓ Seção de números/resultados (300+ projetos, R$79M+ investidos, R$210M+ faturados) — existente
- ✓ Logos de clientes (Grupo UniEduK, Toldos Mundial, Indústrias Moveleiras) — existente
- ✓ Seção de dores/problemas (4 cards) — existente
- ✓ Seção de depoimentos em vídeo (2 vídeos locais) — existente
- ✓ Seção de metodologia (3 etapas) — existente
- ✓ CTA final + footer — existente

### Active

- [ ] Gerar design system via UI Pro Max para a landing page de agência de marketing
- [ ] Aplicar design system gerado ao index.html (paleta, tipografia, estilos elevados)
- [ ] Adicionar animações de entrada (scroll-triggered) com respeito a prefers-reduced-motion
- [ ] Botão de WhatsApp flutuante com número real da GM Marketing
- [ ] Formulário com redirect para WhatsApp ao submeter (wa.me com mensagem pré-preenchida)
- [ ] Seção de FAQ/objeções antes do CTA final
- [ ] Adicionar mais depoimentos textuais (cards com foto, nome, empresa, resultado)
- [ ] SEO básico (meta tags, og:image, og:title, description)
- [ ] Performance: lazy loading em vídeos, imagens otimizadas

### Out of Scope

- Backend/servidor — página estática sem servidor
- Sistema de CRM ou automação — integração futura
- Versão mobile app — web-first
- Múltiplos idiomas — PT-BR apenas

## Context

- Stack: HTML + Tailwind CSS (CDN) — página estática, sem build tool
- Fonte atual: Montserrat (Google Fonts)
- Cor primária: #ff2a2a (vermelho GM)
- Style atual: dark mode, bold/uppercase, performance marketing
- Vídeos de depoimento: `video/IMG_7744.MP4` e `video/IMG_7745.MP4`
- Deployed: Vercel (`.vercel/project.json` presente)
- Público-alvo: donos de empresas que faturam R$50k–R$100M+/mês

## Constraints

- **Stack**: HTML + Tailwind CDN — sem framework JS ou build step
- **Estático**: Nenhuma dependência de servidor — formulário via WhatsApp redirect
- **Assets**: Vídeos e PDFs já na pasta, não remover

## Key Decisions

| Decision | Rationale | Outcome |
|----------|-----------|---------|
| Tailwind CDN sem build | Página simples, deploy rápido no Vercel | — Pending |
| WhatsApp como CTA principal | Conversão direta, sem intermediários | — Pending |
| Design system via UI Pro Max | Elevar qualidade visual com dados reais de design | — Pending |

---
*Last updated: 2026-03-24 after initialization*
