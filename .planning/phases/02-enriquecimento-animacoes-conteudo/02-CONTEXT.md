# Phase 2: Enriquecimento — Animações + Conteúdo - Context

**Gathered:** 2026-03-25
**Status:** Ready for planning

<domain>
## Phase Boundary

Criar uma seção de números dedicada com destaque visual de alto impacto. Os contadores animados (300+, R$79M+, R$210M+) migram do hero para uma seção própria com fundo vermelho GM. As demais entregas da Fase 2 (FAQ, depoimentos, animações fade-up, prefers-reduced-motion) foram antecipadas na Fase 1 e estão concluídas. Apenas SEC-03 permanece pendente.

</domain>

<decisions>
## Implementation Decisions

### Estrutura visual da seção
- Seção dedicada, separada do hero — não manter os números apenas no hero
- Fundo: vermelho GM (#ff2a2a) com texto branco — contraste forte com o dark do restante da página
- Layout: 3 colunas iguais, grid horizontal
- Posição: imediatamente após o hero (antes da seção de logos/clientes)
- Os números do hero devem ser REMOVIDOS e migrados para esta seção dedicada

### Narrativa
- Headline da seção: **"Resultados que falam por si"**
- Sem sub-headline — os números se justificam sozinhos
- Sem narrativa before/after explícita — a relação investido/faturado fica implícita

### Efeito visual de destaque
- Glow/brilho branco no número ao terminar a animação do contador (~300ms de duração)
- Separadores: linha vertical fina branca semi-opaca entre os 3 blocos
- Sem scale-up ou outros efeitos adicionais

### Contexto/legenda dos números
- Textos mantidos exatamente como estão no hero atual:
  - **300+** → "projetos entregues"
  - **R$ 79 Mi+** → "em mídia gerenciada"
  - **R$ 210 Mi+** → "faturados"
- Labels: curtas e diretas, sem ícones, sem uppercase com tracking
- Fonte dos números: grande e impactante — 5xl mobile, 7xl/8xl desktop

### Claude's Discretion
- Padding/espaçamento interno da seção
- Easing da animação do glow
- Comportamento mobile dos separadores (podem virar horizontais ou sumir)
- Opacidade exata da linha separadora

</decisions>

<specifics>
## Specific Ideas

- O fundo vermelho já é o destaque — não precisa de efeitos exagerados
- O glow deve ser sutil: brilho branco que aparece e some suavemente ao fim do contador
- A migração dos números do hero deve deixar o hero mais limpo (só headline, sub, CTA e form)

</specifics>

<code_context>
## Existing Code Insights

### Reusable Assets
- `.counter` + `data-target` + `data-suffix`: sistema de contador já implementado no hero — reutilizar exatamente o mesmo padrão JS
- `.fade-up` + IntersectionObserver: animação de entrada já funcional — aplicar na nova seção
- `v4-red` / `#ff2a2a`: variável de cor vermelha já em uso no design system

### Established Patterns
- Contadores disparam quando entram na viewport via IntersectionObserver
- `prefers-reduced-motion` já tratado globalmente — nova seção herda automaticamente

### Integration Points
- Remover o bloco de 3 colunas de números do hero (`.grid.grid-cols-3.gap-4.pt-6.border-t.border-gray-800`)
- Inserir nova `<section>` após o hero e antes da seção de logos/clientes

</code_context>

<deferred>
## Deferred Ideas

- Nenhuma ideia fora de escopo surgiu durante a discussão

</deferred>

---

*Phase: 02-enriquecimento-animacoes-conteudo*
*Context gathered: 2026-03-25*
