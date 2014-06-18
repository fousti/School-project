# Encoding: UTF-8
import argparse
from time import time
from sklearn.feature_extraction.text import HashingVectorizer
from sklearn.naive_bayes import MultinomialNB
import nltk
import csv

def size_mb(docs):
    return sum(len(s) for s in docs) / 1e6

def convert(path_to_file):
    with open(path_to_file, 'rb') as csvfile:
        for row in csv.reader(csvfile):
            if row[0] == 'document':
                continue
            else:
                yield row

argparser = argparse.ArgumentParser(description="Product Classifier from csv file")
argparser.add_argument('csv_file', help="CSV file containing data to train, and data to classify")
argparser.add_argument('dest_file', help="CSV file which will contain the new classified data")
args = argparser.parse_args()
stop_words = nltk.corpus.stopwords.words('french')
stop_words = [w.decode('utf-8') for w in stop_words]

xtrain = []
ytrain = []
test = []
for line in convert(args.csv_file):
    if line[1]:
        xtrain.append(line[0].decode('utf-8'))
        ytrain.append(line[1].decode('utf-8'))
    else:
        test.append(line[0])

print('Data Loaded\n')
data_train_size_mb = size_mb(xtrain)
data_test_size_mb = size_mb(test)

print("Extracting features from train dataset using a sparse vectorizer\n")
t0 = time()
vectorizer = HashingVectorizer(stop_words=stop_words, non_negative=True, strip_accents='unicode', analyzer="word")
X_train = vectorizer.transform(xtrain)

duration = time() - t0
print("done in %fs at %0.3fMB/s" % (duration, data_test_size_mb / duration))

print("Extracting features from test dataset using a sparse vectorizer\n")
t0 = time()
vectorizer = HashingVectorizer(stop_words=stop_words, non_negative=True, strip_accents='unicode', analyzer="word")
X_test = vectorizer.transform(test)
duration = time() - t0
print("done in %fs at %0.3fMB/s\n" % (duration, data_train_size_mb / duration))
clf = MultinomialNB(alpha=.01)
t0 = time()
clf.fit(X_train, ytrain)
train_time = time() - t0
print("train time: %0.3fs" % train_time)

t0 = time()
pred = clf.predict(X_test)
test_time = time() - t0
print("test time:  %0.3fs\n" % test_time)



print("Writing feature predictions in new csv file\n")
with open(args.dest_file, 'wb') as csvfile:
    writer = csv.writer(csvfile, delimiter=' ',
                            quotechar='|', quoting=csv.QUOTE_MINIMAL)
    for product in test:
        writer.writerow([product, pred[test.index(product)]])
print("Data Classified in %s" % args.dest_file)