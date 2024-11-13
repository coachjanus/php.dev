
export async function fetchData(url) {
    return await fetch(
        url, 
        {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }

        })
    .then(response => {
        if(response.status >= 400) {
            return response.json().then(err => {
                const error = new Error('Something went wrong!');
                error.data = err;
                throw error;
            })
        }
        return response.json();
    })
}