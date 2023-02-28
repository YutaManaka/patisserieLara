import { ref } from 'vue'

export default function preview(refImage) {
  const filePreview = ref(null)
  const openFileView = () => refImage.value.click()
  const onFileChanged = () => {
    const reader = new FileReader()
    reader.onload = (e) => {
      filePreview.value = e.target.result
    }
    reader.readAsDataURL(refImage.value.files[0])
  }

  return {
    filePreview,
    openFileView,
    onFileChanged,
  }
}
