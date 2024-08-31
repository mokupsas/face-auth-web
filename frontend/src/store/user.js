import { createSlice } from '@reduxjs/toolkit'

export const userSlice = createSlice({
  name: 'user',
  initialState: {
    id: null,
    username: null,
  },
  reducers: {
    setUser: (state, action) => {
      state.id = action.payload.id
      state.username = action.payload.username
    },
    removeUser: (state) => {
      state.id = null
      state.username = null
    },
  },
})

// Action creators are generated for each case reducer function
export const { setUser, removeUser } = userSlice.actions

export default userSlice.reducer