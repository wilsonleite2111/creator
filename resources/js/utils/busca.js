/**
 * Normaliza texto para comparação: remove acentos e caixa.
 * Permite que "pericia" encontre "Perícia" e "ilusao" encontre "Ilusão".
 */
export function normalizar(texto) {
    return (texto ?? '')
        .toString()
        .normalize('NFD')
        .replace(/\p{Diacritic}/gu, '')
        .toLowerCase()
        .trim();
}

/**
 * Filtra uma lista pelo campo informado. Termo vazio devolve a lista intacta.
 */
export function filtrarPorNome(lista, termo, campo = 'nome') {
    const alvo = normalizar(termo);
    if (!alvo) return lista ?? [];

    return (lista ?? []).filter((item) => normalizar(item[campo]).includes(alvo));
}
