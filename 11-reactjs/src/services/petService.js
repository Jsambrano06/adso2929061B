import axiosClient from "../api/axiosClient";

export const petService = {
  async list() {
    const { data } = await axiosClient.get("/pets/list");
    return data.pets || [];
  },

  async getById(id) {
    const { data } = await axiosClient.get(`/pets/show/${id}`);
    return data.pet;
  },

  async create(petData) {
    const { data } = await axiosClient.post("/pets/store", petData);
    return data.pet;
  },

  async update(id, petData) {
    const { data } = await axiosClient.put(`/pets/edit/${id}`, petData);
    return data.pet;
  },

  async remove(id) {
    await axiosClient.delete(`/pets/delete/${id}`);
  },
};
