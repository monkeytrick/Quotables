<script>

export default function fetchHandler (url) {
    return fetch(url, {mode: 'cors'})
    .then((res) => {
        if(!res.ok) {
            throw Error('Fetch error by me!')
        }
        return res.json();
    })
    //return data
    .then((data) => {
        return data;
    })
    .catch((e) => console.log(e))
}

</script>

