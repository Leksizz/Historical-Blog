export async function fetchData(url) {
    const response = await $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json'
    });
    if (response.result !== null && Object.keys(response.result).length - 1 > 0) {
        return response.result;
    } else {
        window.location.href = '/404';
    }
}
