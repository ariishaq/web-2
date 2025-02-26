import sys
import pandas as pd
import numpy as np
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import MinMaxScaler

# Baca data dari file CSV
csv_file = sys.argv[1]
data = pd.read_csv(csv_file)

# Normalisasi nilai untuk masing-masing aspek
scaler = MinMaxScaler()
data[['kedisiplinan', 'kinerja', 'sikap_kerja', 'keahlian']] = scaler.fit_transform(
    data[['kedisiplinan', 'kinerja', 'sikap_kerja', 'keahlian']]
)

# Hitung total nilai berdasarkan bobot
data['total_nilai'] = (
    data['kedisiplinan'] * 0.4 +
    data['kinerja'] * 0.3 +
    data['sikap_kerja'] * 0.15 +
    data['keahlian'] * 0.15
)

# Buat label untuk klasifikasi (1 = karyawan terbaik)
data['label'] = np.where(data['total_nilai'] == data['total_nilai'].max(), 1, 0)

# Model Random Forest
X = data[['kedisiplinan', 'kinerja', 'sikap_kerja', 'keahlian', 'total_nilai']]
y = data['label']

model = RandomForestClassifier(n_estimators=100, random_state=42)
model.fit(X, y)

# Prediksi karyawan terbaik
data['predicted_best'] = model.predict(X)

# Ambil ID karyawan terbaik berdasarkan prediksi
best_employee_id = data.loc[data['predicted_best'] == 1, 'user_id'].values[0]

# Output hasil ke Laravel
print(best_employee_id)
