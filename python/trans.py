# -*- coding:UTF-8 -*-
import sys
import jieba

word = sys.argv[1];
word_list = jieba.cut(word)
print(",".join(word_list))
