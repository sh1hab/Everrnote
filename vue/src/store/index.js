import {createStore} from "vuex";
import axiosClient from "../axios.js";

const store = createStore({
    state: {
        loading: false,
        currentContact: {},
        contacts: {
            data: [],
            links: [],
            meta: {}
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
        currentNote: {
            data: {}
        },
        notes: {
            data: {}
        },
        questionTypes: ["text", "select", "radio", "checkbox", "textarea"],
        surveys: {
            data: [],
            loading: false,
            links: [],
        },
        accounts: {
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
            return axiosClient.delete('/surveys/' + id)
                .then(response => {
                    // commit('setSurveys', response.data.contacts);
                    return response
                });
        },
        deleteNote({commit}, id) {
            return axiosClient.delete('/notes/' + id)
                .then(response => {
                    return response
                })
        },
        deleteContact({commit}, id) {
            return axiosClient.delete('/contacts/' + id)
                .then(response => {
                    return response
                })
        },
        getContacts({commit}, {url = ''} = {}) {
            commit('setLoading', true);
            url = '/contacts'+url;

            return axiosClient.get(url)
                .then(response => {
                    commit('setContacts', response);
                    commit('setLoading', false);
                    return response
                });
        },
        getSurvey({commit}, id) {
            commit('setCurrentSurveyLoading', true);
            return axiosClient.get(`/surveys/${id}`)
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
        getSurveys({commit}, {url = null} = {}) {
            url = url || '/surveys';
            commit('setSurveysLoading', true);
            return axiosClient.get(url)
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
        getNote({commit}, id) {
            commit('setLoading', true);
            return axiosClient.get(`/notes/${id}`)
                .then(response => {
                    commit('setCurrentNote', response.data);
                    return response
                })
                .catch((err) => {
                    throw  err;
                })
                .finally(() => {
                    commit('setLoading', false);
                });
        },
        getNotes({commit}, {url = null} = {}) {
            url = url || '/notes';
            // commit('setSurveysLoading', true);
            return axiosClient.get(url)
                .then(response => {
                    commit('setNotes', response.data);
                    return response
                })
                .catch((err) => {
                    throw  err;
                })
                .finally(() => {
                    // commit('setSurveysLoading', false);
                });
        },
        login({commit}, user) {
            return axiosClient.post('/auth/login', user)
                .then(response => {
                    commit('setUser', response.data.data.user);
                    commit('setToken', response.data.data.token);
                    return response
                })
        },
        logout({commit}) {
            return axiosClient.post('/auth/logout')
                .then(response => {
                    commit('logout');
                    return response
                });
        },
        register({commit}, user) {
            return axiosClient.post('/auth/register', user)
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
        getContact({commit}, id) {
            return axiosClient.get('/contacts/' + id)
                .then(response => {
                    commit('setCurrentContact', response.data);
                    return response
                })
        },
        saveContact({commit}, contact) {
            let response;
            if (contact.id) {
                response = axiosClient.put(`/contacts/${contact.id}`, contact)
                    .then(response => {
                        return response;
                    })
            } else {
                response = axiosClient.post('/contacts', contact)
                    .then(response => {
                        return response;
                    })
            }

            return response
        },
        saveNote({commit}, note) {
            let response;
            if (note.id) {
                response = axiosClient.put(`/notes/${note.id}`, note)
                    .then(response => {
                        return response
                    })
            } else {
                response = axiosClient.post(`/notes`, note)
                    .then(response => {
                        return response
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
        },
        getAccounts({commit}){
            axiosClient.get('/accounts')
                .then(response => {
                    commit('setAccounts', response.data.data.accounts);
                    return response;
                })
        }
    },
    mutations: {
        logout: state => {
            state.user.data = {};
            state.user.token = null;
        },
        setLoading(state, loading) {
            state.loading = loading;
        },
        setUser(state, user) {
            state.user.data = user;
        },
        setToken(state, token) {
            state.user.token = token;
            sessionStorage.setItem('TOKEN', token);
        },
        setCurrentContact(state, contact) {
            state.currentContact = contact;
        },
        setContacts(state, contacts) {
            state.contacts.data = contacts.data;
            state.contacts.meta = contacts.meta;
            state.contacts.links = contacts.links;
        },
        setCurrentNote(state, note) {
            state.currentNote.data = note.data;
        },
        setNotes(state, notes) {
            state.notes.data = notes.data;
            state.notes.meta = notes.meta;
            state.notes.links = notes.links;
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
            state.surveys.meta = surveys.meta;
        },
        updateSurvey(state, survey) {
            state.surveys.data = state.surveys.map(survy => {
                if (survy.id === survey.id) {
                    return survey
                }
                return survy
            })
        },
        notify: (state, {message, type}) => {
            state.notification.show = true;
            state.notification.message = message;
            state.notification.type = type;
            setTimeout(() => {
                state.notification.show = false
            }, 5000)
        },
        setAccounts(state, accounts){
            state.accounts.meta = accounts.meta;
            state.accounts.links = accounts.meta.links;
            state.accounts.data = accounts.data;
        }
    },
    modules: {}
});

export default store;

