<template>
    <div class="row">
        <div class="col">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Search Albums by Artist
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Search Albums</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <form @submit.prevent="fetchAlbums">
                                    <div class="mb-3">
                                        <label for="searchArtist" class="form-label">Artist Name</label>
                                        <input type="text" class="form-control" id="searchArtist" v-model="artistName">

                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary block">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div v-if="isFound && artistAlbums.length > 0" class="pt-4">

                                <div class="row" v-for="(album, index) in paginatedAlbums" :key="index">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-md-3 text-center my-2">
                                                <img :src="album.image" alt="album cover" width="100">
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <h6 class=" text-center bg-primary text-white rounded-pill p-2">{{ album.name }}
                                                </h6>
                                                <ul>
                                                    <li>{{ album.sales }} sales</li>
                                                    <li>Released on {{ album.year }}</li>
                                                    <li>Last Updated on {{ album.updated_at }}</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <nav v-if="artistAlbums.length >= 3" aria-label="Page navigation example"
                                    class="d-flex align-items-center justify-content-center">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#" @click="previousPage"
                                                :disabled="currentPage === 1">Previous</a>
                                        </li>
                                        <li class="page-item" v-for="pageNumber in totalPages" :key="pageNumber"
                                            :class="{ active: pageNumber === currentPage }">
                                            <a class="page-link" href="#"
                                                @click="changePage(pageNumber)">{{ pageNumber }}</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" @click="nextPage"
                                                :disabled="currentPage === totalPages">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div v-if="isFound == false" class="text-center m-5">
                                    <p>No albums found for the artist "{{ artistName }}"</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import axios from 'axios';
    import {
        ref, computed, watch
    } from 'vue';

    const artistName = ref('');
    const isFound = ref(null);
    const artistAlbums = ref([]);

    const currentPage = ref(1);
    const pageSize = 3
    const totalPages = computed(() => Math.ceil(artistAlbums.value.length / pageSize));

    const changePage = (page) => {
        currentPage.value = page;
    };

    const previousPage = () => {
        if (currentPage.value > 1) {
            currentPage.value--;
        }
    };

    const nextPage = () => {
        if (currentPage.value < totalPages.value) {
            currentPage.value++;
        }
    };

    const paginatedAlbums = computed(() => {
        const startIndex = (currentPage.value - 1) * pageSize;
        const endIndex = startIndex + pageSize;
        return artistAlbums.value.slice(startIndex, endIndex);
    });

    const listAlbumsByArtist = async () => {
        try {
            const response = await axios.get(
                `http://127.0.0.1:8000/api/dashboard/by-artist/${artistName.value}`);

            artistAlbums.value = response.data;

            //console.log(artistAlbums.value[0])

            isFound.value = true;

        } catch (error) {
            isFound.value = false;
            setTimeout(() => {
                isFound.value = null;
            }, 2000);
            console.error('Error listing albums by artist:', error);
            
        }
    };

    const fetchAlbums = async () => {
        await listAlbumsByArtist();
    };

</script>