export default {
  props: {
    title: {
      type: String,
      required: false,
      default: 'Auth'
    },
    'text-color': {
      type: String,
      required: false,
      default: 'white'
    },
    'button-color': {
      type: String,
      required: false,
      default: 'blue'
    },
    'button-text-color': {
      type: String,
      required: false,
      default: 'white'
    },
    logo: {
      type: String,
      required: false,
      default: 'wifi.png'
    },
    'background-type': {
      type: String,
      required: false,
      default: 'fill'
    },
    'background-color': {
      type: String,
      required: false,
      default: '#cc0000'
    },
    banner: {
      type: String,
      required: false
    },
    'oy-logo-color': {
      type: String,
      required: false,
      default: 'white'
    }
  }
}