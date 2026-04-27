export default async function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).json({ error: 'Método não permitido' });
  }

  const { empresa, telefone, cnpj, objetivo, faturamento, quando, utms = {} } = req.body;

  console.log('[kommo] payload recebido:', { empresa, telefone, faturamento, quando, utms });

  const TOKEN = process.env.KOMMO_TOKEN;
  const SUBDOMAIN = process.env.KOMMO_SUBDOMAIN || 'comercialgmmkt';

  const FIELD_CNPJ        = process.env.KOMMO_FIELD_CNPJ        || 3889840;
  const FIELD_OBJETIVO    = process.env.KOMMO_FIELD_OBJETIVO    || 3889842;
  const FIELD_FATURAMENTO = process.env.KOMMO_FIELD_FATURAMENTO || 3889844;
  const FIELD_QUANDO      = process.env.KOMMO_FIELD_QUANDO      || 3889846;

  // Tags a partir dos UTMs
  const utmTags = [];
  if (utms.utm_source)   utmTags.push({ name: `src:${utms.utm_source}` });
  if (utms.utm_medium)   utmTags.push({ name: `mid:${utms.utm_medium}` });
  if (utms.utm_campaign) utmTags.push({ name: `cmp:${utms.utm_campaign}` });
  if (utms.utm_content)  utmTags.push({ name: `cnt:${utms.utm_content}` });
  if (utms.utm_term)     utmTags.push({ name: `trm:${utms.utm_term}` });

  console.log('[kommo] utmTags:', utmTags);

  // Texto da nota
  const utmNote = Object.keys(utms).length
    ? 'UTMs do Lead:\n' + Object.entries(utms).map(([k, v]) => `${k}: ${v}`).join('\n')
    : null;

  try {
    const leadBody = [{
      name: empresa,
      custom_fields_values: [
        { field_id: parseInt(FIELD_CNPJ),        values: [{ value: cnpj        || '' }] },
        { field_id: parseInt(FIELD_OBJETIVO),    values: [{ value: objetivo    || '' }] },
        { field_id: parseInt(FIELD_FATURAMENTO), values: [{ value: faturamento || '' }] },
        { field_id: parseInt(FIELD_QUANDO),      values: [{ value: quando      || '' }] }
      ],
      _embedded: {
        tags: utmTags,
        contacts: [{
          name: empresa,
          custom_fields_values: [{
            field_code: 'PHONE',
            values: [{ value: telefone, enum_code: 'WORK' }]
          }]
        }]
      }
    }];

    const response = await fetch(`https://${SUBDOMAIN}.kommo.com/api/v4/leads/complex`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${TOKEN}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(leadBody)
    });

    const data = await response.json();
    console.log('[kommo] resposta Kommo:', JSON.stringify(data));

    if (!response.ok) {
      console.error('[kommo] Kommo API Error:', data);
      return res.status(400).json({ status: 'error', details: JSON.stringify(data) });
    }

    // Extrai o ID do lead criado — tenta os dois formatos possíveis de resposta
    const leadId = data?.[0]?.id || data?._embedded?.leads?.[0]?.id;
    console.log('[kommo] leadId:', leadId);

    // Cria nota com UTMs
    if (utmNote && leadId) {
      const noteRes = await fetch(`https://${SUBDOMAIN}.kommo.com/api/v4/leads/${leadId}/notes`, {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${TOKEN}`,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify([{ note_type: 'common', params: { text: utmNote } }])
      });
      const noteData = await noteRes.json();
      console.log('[kommo] nota criada:', JSON.stringify(noteData));
    } else if (utmNote && !leadId) {
      console.warn('[kommo] leadId não encontrado — nota não criada. Resposta completa:', JSON.stringify(data));
    }

    return res.status(200).json({ status: 'ok', leadId });
  } catch (error) {
    console.error('[kommo] Integration Error:', error);
    return res.status(500).json({ status: 'error', message: error.message });
  }
}
