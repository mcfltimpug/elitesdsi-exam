<template>
     <div class="row">
      <div class="col-12">
        <div class="card mb-3 mx-auto d-flex p-3">
          <div class="row g-0 d-flex align-items-center justify-content-center">
            <div class="col-md-4 text-center mx-auto">
              <img
                src="../../assets/trophy.png"
                class="img-fluid rounded-start"
                alt="top artist icon"
                width="100"
                height="auto"
              />
            </div>
            <div class="col-md-8">
              <div class="card-body text-center">
                <h2 class="card-title fs-1">{{ topArtist.name }}</h2>
                <p class="card-text fst-italic text-primary">
                  Top Selling Artist with {{ topArtist.sales }} sales
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";

const topArtist = ref([
  {
    name: "",
    sales: "",
  },
]);

const loadTopArtist = async () => {
  try {
    const response = await axios.get(
      "http://127.0.0.1:8000/api/dashboard/top-one-artist"
    );

    //console.log(response.data[0])
    const { artist, combined_sales } = response.data[0];

    topArtist.value = {
      name: artist.name,
      sales: combined_sales,
    };
  } catch (error) {
    console.error("Error loading top artist:", error);
  }
};

onMounted(() => {
  loadTopArtist();
});
</script>