export async function fetchData(url) {
    const response = await $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json'
    });
    return response.result;
}
