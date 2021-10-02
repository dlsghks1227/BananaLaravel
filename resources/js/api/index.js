import axios from "axios";

const axiosService = axios.create({
    baseURL: 'http://125.134.138.184/'
});

export const counterIncrease = function()
{
    return axiosService.post('increase');
}