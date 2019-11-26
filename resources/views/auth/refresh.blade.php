<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    axios.post('/refresh', {
        params: {
            refresh_token:"def502001a0f7ea8dbf4b920352545cea66607ae96d01561b7bb08a91a1e65aa2c0cb848770e8f36ee8bb93dcda80a7a0c160b30259c3fbf9d8726673b98eeffb3affb3514d1a09da9e9a0acc97c7eacde1e16d10147b3754740540af9ea84de9ddcb241969e40b061ca790b03790259d1993142b8d6a84f855391918bf2a18340e156cd747c2a747b29cb11269ef6e3b9404c101d1b27dcccd7f37f1ffded6208a36b665f04f4ee5f354d3aa3bf772f2d331f5af1b8c45e6a42b4efc372377947c2aa8840e881aa7a7cf5e620548a0f74eca363d1ade4f35be0661cdeccdf29a0b3aeb66b8ba0e17486e09687d8324cda61ff7ec3236c75b85bd7b9da13efaa2ae4786283d706712c41457ef06f3459a00858ee732a8b2ff8cf6b6c35d2f41fe1a0ab4a68a27a7c52e4500c35525cf9545bf7671cb6fdece84ecde2233861cfaf8a7b25e408a544bdd8dd52d3ac709921336d775ac54faedeebe315e3655da5f9",
        }
    })
        .then(function (response){
            console.log(response.data);
        });
</script>
