# Encoding: UTF-8
"""
Contains CSV converter
"""
import csv
import os

class CsvConverter(object):
    """
    Convert CSV data into Graph representation
    CSV format : ['source', 'target', 'distance']
    """
    def convert(self, path_to_file):
        with open(path_to_file, 'rb') as csvfile:
            for row in csv.reader(csvfile):
                if row[0] == 'source':
                    pass
                else:
                    yield self.format(row)

    def format(self, row):
        """
		Formating CSV row : ['source', 'target', 'distance']
		"""
        return row