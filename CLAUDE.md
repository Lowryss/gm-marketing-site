# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

GM Marketing — repositório para desenvolvimento de interfaces e materiais digitais de marketing.

## UI/UX Pro Max Skill

A skill `ui-ux-pro-max` está instalada em `.claude/skills/ui-ux-pro-max/`. Use-a para todo trabalho de UI/UX.

### Fluxo obrigatório

**1. Gerar design system (sempre primeiro):**
```bash
python3 .claude/skills/ui-ux-pro-max/scripts/search.py "<tipo_produto> <industria> <keywords>" --design-system -p "Nome do Projeto"
```

**2. Persistir design system (para projetos multi-página):**
```bash
python3 .claude/skills/ui-ux-pro-max/scripts/search.py "<query>" --design-system --persist -p "Nome do Projeto"
# Cria design-system/MASTER.md + design-system/pages/
```

**3. Busca por domínio específico:**
```bash
python3 .claude/skills/ui-ux-pro-max/scripts/search.py "<keyword>" --domain <domain> [-n <max_results>]
```

**4. Guidelines por stack (padrão: html-tailwind):**
```bash
python3 .claude/skills/ui-ux-pro-max/scripts/search.py "<keyword>" --stack html-tailwind
```

### Domínios disponíveis
`product` · `style` · `typography` · `color` · `landing` · `chart` · `ux` · `react` · `web` · `prompt`

### Stacks disponíveis
`html-tailwind` (padrão) · `react` · `nextjs` · `vue` · `svelte` · `shadcn` · `swiftui` · `react-native` · `flutter` · `jetpack-compose`

### Hierarquia de design system
Ao construir páginas específicas:
1. Verificar `design-system/pages/<pagina>.md` primeiro (overrides)
2. Fallback para `design-system/MASTER.md`

## Regras de UI profissional

- Usar SVG icons (Heroicons, Lucide) — nunca emojis como ícones
- `cursor-pointer` em todos os elementos clicáveis
- Transições suaves: `transition-colors duration-200` (150–300ms)
- Contraste mínimo 4.5:1 para texto — não usar cores abaixo de `slate-600` para texto em light mode
- Cards com glass em light mode: `bg-white/80` mínimo (nunca `bg-white/10`)
- Navbar flutuante: espaço `top-4 left-4 right-4` das bordas
- Responsive testado em: 375px, 768px, 1024px, 1440px
