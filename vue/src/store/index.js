import {createStore} from "vuex";
import axiosClient from "../axios.js";

const tmpSurveys = [
    {
        id: 1,
        title: 'thecodeholic Youtube channel content',
        slug: '',
        status: 'draft',
        image: 'https://media.istockphoto.com/photos/mountain-landscape-picture-id517188688?k=20&m=517188688&s=612x612&w=0&h=i38qBm2P-6V4vZVEaMy_TaTEaoCMkYhvLCysE7yJQ5Q=',
        upload: {},
        description: `My name is hashi,  <br>i like to drink o cha, lets start ni, ichi, san, yon, go, roku`,
        questions: [{
            id: 1,
            type: 'select',
            question: '',
            description: '',
            data: {
                options: [
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "GERMANY"}

                ]
            }
        }],
    },
    {
        id: 2,
        title: 'Survey 2',
        image: "https://cdn.pixabay.com/photo/2014/02/27/16/10/flowers-276014__340.jpg",
        slug: '',
        status: 'active',
        upload: {},
        description: ' hi there',
        questions: [{
            id: 1,
            type: 'select',
            question: '',
            description: '',
            data: {
                options: [
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "GERMANY"}

                ]
            }
        }],
    },
    {
        id: 3,
        title: 'Survey 3',
        slug: '',
        status: 'active',
        image: "https://cdn.pixabay.com/photo/2014/02/27/16/10/flowers-276014__340.jpg",
        upload: {},
        description: 'do want to take survey',
        questions: [{
            id: 1,
            type: 'select',
            question: '',
            description: '',
            data: {
                options: [
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "GERMANY"}

                ]
            }
        }],
    },
    {
        id: 2,
        title: 'Survey 2',
        image: "https://cdn.pixabay.com/photo/2014/02/27/16/10/flowers-276014__340.jpg",
        slug: '',
        status: 'active',
        upload: {},
        description: ' hi there',
        questions: [{
            id: 1,
            type: 'select',
            question: '',
            description: '',
            data: {
                options: [
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "USA"},
                    {uuid: "f35454512121-1ddfd-ddsd-dfd-sdfddffd", text: "GERMANY"}

                ]
            }
        }],
    },
];

const store = createStore({
    state: {
        contacts: {
            data: {}
        },
        currentSurvey: {
            data: {},
            loading: false,
        },
        notification: {
            message: null,
            show: false,
            type: ''
        },
        questionTypes: ["text", "select", "radio", "checkbox", "textarea"],
        surveys: {
            data: [],
            loading: false,
            links: [],
        },
        user: {
            data: {},
            token: sessionStorage.getItem('TOKEN')
        }
    },
    getters: {},
    actions: {
        deleteSurvey({commit}, id) {
            axiosClient.delete('/surveys/' + id)
                .then(response => {
                    // commit('setSurveys', response.data.contacts);
                    return response
                });
        },
        fetchContacts({commit}) {
            axiosClient.get('/contacts')
                .then(response => {
                    commit('setContacts', response.data.contacts);
                    return response
                });
        },
        getSurvey({commit}, id) {
            commit('setCurrentSurveyLoading', true);
            axiosClient.get(`/surveys/${id}`)
                .then(response => {
                    commit('setCurrentSurvey', response.data.data);
                    return response
                })
                .catch((err) => {
                    throw  err;
                })
                .finally(() => {
                    commit('setCurrentSurveyLoading', false);
                });
        },
        getSurveys({commit}, {url = null} = {} ) {
            console.log(url);
            url = url || '/surveys';
            commit('setSurveysLoading', true);
            axiosClient.get(url)
                .then(response => {
                    commit('setSurveys', response.data);
                    return response
                })
                .catch((err) => {
                    throw  err;
                })
                .finally(() => {
                    commit('setSurveysLoading', false);
                });
        },
        login({commit}, user) {
            axiosClient.post('/auth/login', user)
                .then(response => {
                    commit('setUser', response.data.data.user);
                    commit('setToken', response.data.data.token);
                    return response
                });
        },
        logout({commit}) {
            axiosClient.post('/auth/logout')
                .then(response => {
                    commit('logout');
                    return response
                });
        },
        register({commit}, user) {
            axiosClient.post('/auth/register', user)
                .then(response => {
                    commit('setUser', response.data.data.user);
                    commit('setToken', response.data.data.token);
                    return response
                });
        },
        saveSurvey({commit}, survey) {
            let response;
            if (survey.id) {
                response = axiosClient.put(`/surveys/${survey.id}`, survey)
                    .then(response => {

                        // commit('updateSurvey', response.data.data.survey);
                        return response;
                    })
            } else {
                response = axiosClient.post('/surveys', survey)
                    .then(response => {
                        // commit('saveSurvey', response.data.data.survey);
                        return response;
                    })
            }

            return response
        },
        getUser({commit}) {
            axiosClient.get('auth/user')
                .then(response => {
                    commit('setUser', response.data.data.user);
                    return response;
                })
        }
    },
    mutations: {
        logout: state => {
            state.user.data = {};
            state.user.token = null;
        },
        setUser(state, user) {
            state.user.data = user;
        },
        setToken(state, token) {
            state.user.token = token;
            sessionStorage.setItem('TOKEN', token);
        },
        setContacts(state, contacts) {
            state.contacts.data = contacts;
        },
        saveSurvey(state, survey) {
            state.surveys.data = [...state.surveys.data, survey];
        },
        setCurrentSurveyLoading(state, loading) {
            state.currentSurvey.loading = loading;
        },
        setCurrentSurvey(state, survey) {
            state.currentSurvey.data = survey;
        },
        setSurveysLoading(state, loading) {
            state.surveys.loading = loading;
        },
        setSurveys: (state, surveys) => {
            state.surveys.links = surveys.meta.links;
            state.surveys.data = surveys.data;
        },
        updateSurvey(state, survey) {
            state.surveys.data = state.surveys.map(survy => {
                if (survy.id === survey.id) {
                    return survey
                }
                return survy
            })
        },
        notify: (state, {message, type})=>{
            state.notification.show = true;
            state.notification.message = message;
            state.notification.type = type;
            setTimeout(()=>{
                state.notification.show = false
            }, 5000)
        }
    },
    modules: {}
});

export default store;



