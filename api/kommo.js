export default async function handler(req, res) {
  if (req.method !== 'POST') {
    return res.status(405).json({ error: 'Método não permitido' });
  }

  const { empresa, telefone, cnpj, objetivo, faturamento, quando } = req.body;

  const TOKEN = process.env.KOMMO_TOKEN;
  const SUBDOMAIN = process.env.KOMMO_SUBDOMAIN || 'comercialgmmkt';

  // Field IDs: use environment variables with defaults for the new client account
  const FIELD_CNPJ = process.env.KOMMO_FIELD_CNPJ || 3889840;
  const FIELD_OBJETIVO = process.env.KOMMO_FIELD_OBJETIVO || 3889842;
  const FIELD_FATURAMENTO = process.env.KOMMO_FIELD_FATURAMENTO || 3889844;
  const FIELD_QUANDO = process.env.KOMMO_FIELD_QUANDO || 3889846;

  try {
    const response = await fetch(`https://${SUBDOMAIN}.kommo.com/api/v4/leads/complex`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${TOKEN}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify([{
        name: empresa,
        custom_fields_values: [
          { field_id: parseInt(FIELD_CNPJ), values: [{ value: cnpj || '' }] },
          { field_id: parseInt(FIELD_OBJETIVO), values: [{ value: objetivo || '' }] },
          { field_id: parseInt(FIELD_FATURAMENTO), values: [{ value: faturamento || '' }] },
          { field_id: parseInt(FIELD_QUANDO), values: [{ value: quando || '' }] }
        ],
        _embedded: {
          contacts: [{
            name: empresa,
            custom_fields_values: [{
              field_code: 'PHONE',
              values: [{ value: telefone, enum_code: 'WORK' }]
            }]
          }]
        }
      }])
    });

    const data = await response.json();

    if (!response.ok) {
      console.error('Kommo API Error:', data);
      return res.status(400).json({ status: 'error', debug_subdomain: SUBDOMAIN, debug_token_len: TOKEN ? TOKEN.length : 0, details: JSON.stringify(data) });
    }

    return res.status(200).json({ status: 'ok' });
  } catch (error) {
    console.error('Integration Error:', error);
    return res.status(500).json({ status: 'error', message: error.message });
  }
}
